<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\DataTables\TeacherDataTable;
use App\Repositories\Contracts\TeacherInterface;
use App\Http\Requests\Teacher\CreateTeacher;
use App\Http\Requests\Teacher\UpdateTeacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{

    protected $teacherRepository;

    public function __construct(TeacherInterface $teacherRepository)
    {
        $this->middleware('auth');
        $this->teacherRepository = $teacherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TeacherDataTable $dataTable)
    {
        return $dataTable->render('admin.teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTeacher $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            if (\request()->hasFile('image')) {
                $data['image'] = $this->teacherRepository->saveFileUpload($data['image'],'images');
            }
            $this->teacherRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_teacher_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_teacher_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = $this->teacherRepository->getOneById($id);
        return view('admin.teacher.update', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateTeacher $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $teacher = $this->teacherRepository->getOneById($id);
            if (\request()->hasFile('image')) {
                $data['image'] = $this->teacherRepository->saveFileUpload($data['image'],'images');
            }
            $teacher->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_teacher_success'));
            return redirect()->route('admin.teacher.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_teacher_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->teacherRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_teacher_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $teacher = $this->teacherRepository->getOneById($id);
        $teacher->update(['active' => !$teacher->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_teacher_success')
        ];
    }
}
