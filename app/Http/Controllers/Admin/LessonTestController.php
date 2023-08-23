<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LessonTest;
use Illuminate\Http\Request;
use App\DataTables\LessonTestDataTable;
use App\Repositories\Contracts\LessonTestInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LessonTest\CreateLessonTest;
use App\Http\Requests\LessonTest\UpdateLessonTest;

class LessonTestController extends Controller
{
    protected $lessonTestRepository;

    public function __construct(LessonTestInterface $lessonTestRepository)
    {
        $this->lessonTestRepository = $lessonTestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LessonTestDataTable $dataTable)
    {
        return $dataTable->render('admin.test.lesson-test.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.test.lesson-test.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLessonTest $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $model = $this->lessonTestRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_lesson_test_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_lesson_test_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonTest  $lessonTest
     * @return \Illuminate\Http\Response
     */
    public function show(LessonTest $lessonTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonTest  $lessonTest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = $this->lessonTestRepository->getOneById($id);
        return view('admin.test.lesson-test.update',compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonTest  $lessonTest
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateLessonTest $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $lesson = $this->lessonTestRepository->getOneById($id);
            $lesson->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_lesson_test_success'));
            return redirect()->route('admin.lesson-test.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_lesson_test_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonTest  $lessonTest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->lessonTestRepository->delete($id);
        return [
            'status' => true,
            'message' => trans('message.delete_lesson_test_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $lesson = $this->lessonTestRepository->getOneById($id);
        $lesson->update(['active' => !$lesson->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_lesson_success')
        ];
    }
}
