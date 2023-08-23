<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\QuestionTestDataTableScope;
use App\Http\Controllers\Controller;
use App\Models\QuestionTest;
use App\Models\QuestionItemTest;
use Illuminate\Http\Request;
use App\DataTables\QuestionTestDataTable;
use App\Http\Requests\QuestionTest\CreateQuestionTest;
use App\Http\Requests\QuestionTest\UpdateQuestionTest;
use App\Repositories\Contracts\QuestionTestInterface;
use App\Repositories\Contracts\LessonTestInterface;
use App\Repositories\Contracts\QuestionTypeTestInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuestionTestController extends Controller
{
    protected $questionTestRepository, $lessonTestRepository, $questionTypeTestRepository;
    public function __construct(
        QuestionTestInterface $questionTestRepository,
        LessonTestInterface $lessonTestRepository,
        QuestionTypeTestInterface $questionTypeTestRepository
    )
    {
        $this->questionTestRepository = $questionTestRepository;
        $this->lessonTestRepository = $lessonTestRepository;
        $this->questionTypeTestRepository = $questionTypeTestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionTestDataTable $dataTable)
    {
        $data = request()->all();
        $lessons = $this->lessonTestRepository->getAll();
        $types = $this->questionTypeTestRepository->getAll();
        return $dataTable->addScope(new QuestionTestDataTableScope())->render('admin.test.question-test.index',compact('lessons','data','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_id = request()->query('type_id');
        $lesson = $this->lessonTestRepository->getAll();
        $type = $this->questionTypeTestRepository->getAll();
        $listAnswer = [];
        return view('admin.test.question-test.create',compact('lesson','type','listAnswer','type_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionTest $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $answers = $data['answer'];
            $answer_true = $data['answer_true'];
            $question = $this->questionTestRepository->create($data);
            $listAnswer = QuestionItemTest::where('question_id', $question->id)->get();
            foreach ($answers as $key => $item) {
                if (isset($listAnswer[$key])) {
                    $listAnswer[$key]->update([
                        'question_id' => $question->id,
                        'content_answer' => $item,
                        'answer' => (in_array($key, $answer_true) ? 1 : 0),
                    ]);
                } else {
                    $newAnswer = new QuestionItemTest;
                    $newAnswer->question_id = $question->id;
                    $newAnswer->content_answer = $item;
                    $newAnswer->answer = (in_array($key, $answer_true) ? 1 : 0);
                    $newAnswer->save();
                }
            }
            DB::commit();
            Session::flash('success', trans('message.create_question_test_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_question_test_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionTest  $questionTest
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionTest $questionTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionTest  $questionTest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type_id = request()->query('type_id');
        $lesson = $this->lessonTestRepository->getAll();
        $type = $this->questionTypeTestRepository->getAll();
        $question = $this->questionTestRepository->getOneById($id,['questionItemTest']);
        $listAnswer = $question->questionItemTest;
        return view('admin.test.question-test.update',compact('question','lesson','type','listAnswer','type_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionTest  $questionTest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionTest $req, $id)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $answers = $data['answer'];
            $answer_true = $data['answer_true'];
            $question = $this->questionTestRepository->getOneById($id);
            $listAnswer = QuestionItemTest::where('question_id', $question->id)->get();
            foreach ($answers as $key => $item) {
                if (isset($listAnswer[$key])) {
                    $listAnswer[$key]->update([
                        'question_id' => $question->id,
                        'content_answer' => $item,
                        'answer' => (in_array($key, $answer_true) ? 1 : 0),
                    ]);
                } else {
                    $newAnswer = new QuestionItemTest;
                    $newAnswer->question_id = $question->id;
                    $newAnswer->content_answer = $item;
                    $newAnswer->answer = (in_array($key, $answer_true) ? 1 : 0);
                    $newAnswer->save();
                }
            }
            $question->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_question_test_success'));
            return redirect()->route('admin.question-test.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_question_test_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionTest  $questionTest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->questionTestRepository->delete($id);
        return [
            'status' => true,
            'message' => trans('message.delete_question_test_success')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionItemTest  $questionTest
     * @return \Illuminate\Http\Response
     */
    public function destroyItem($id)
    {
        $questionItems = QuestionItemTest::where('question_id', $id)->get();
        foreach ($questionItems as $questionItem) {
            $questionItem->delete();
        }
        return [
            'status' => true,
            'message' => trans('message.delete_question_item_test_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $question = $this->questionTestRepository->getOneById($id);
        $question->update(['active' => !$question->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_question_success')
        ];
    }
}
