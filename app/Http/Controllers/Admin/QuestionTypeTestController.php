<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionTypeTest;
use Illuminate\Http\Request;
use App\DataTables\QuestionTypeTestDataTable;
use App\Http\Requests\QuestionTypeTest\CreateQuestionTypeTest;
use App\Http\Requests\QuestionTypeTest\UpdateQuestionTypeTest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Repositories\Contracts\QuestionTypeTestInterface;

class QuestionTypeTestController extends Controller
{

    protected $questionTypeTestRepository;

    public function __construct(QuestionTypeTestInterface $questionTypeTestRepository)
    {
        $this->questionTypeTestRepository = $questionTypeTestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionTypeTestDataTable $dataTable)
    {
        return $dataTable->render('admin.test.question-type-test.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.test.question-type-test.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionTypeTest $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $model = $this->questionTypeTestRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_question_type_test_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_question_type_test_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionTypeTest  $questionTypeTest
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionTypeTest $questionTypeTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionTypeTest  $questionTypeTest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questionType = $this->questionTypeTestRepository->getOneById($id);
        return view('admin.test.question-type-test.update',compact('questionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionTypeTest  $questionTypeTest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionTypeTest $req, $id)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $lesson = $this->questionTypeTestRepository->getOneById($id);
            $lesson->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_question_type_test_success'));
            return redirect()->route('admin.question-type-test.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_question_type_test_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionTypeTest  $questionTypeTest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->questionTypeTestRepository->delete($id);
        return [
            'status' => true,
            'message' => trans('message.delete_question_type_test_success')
        ];
    }
}
