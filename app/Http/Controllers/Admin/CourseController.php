<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\DataTables\CourseDataTable;
use App\Repositories\Contracts\CourseInterface ;
use App\Http\Requests\Course\CreateCourse;
use App\Http\Requests\Course\UpdateCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    protected $courseRepository;
    protected $resizeImage;

    public function __construct(CourseInterface $courseRepository)
    {
        $this->middleware('auth');
        $this->courseRepository = $courseRepository;
        $this->resizeImage = $this->courseRepository->resizeImage();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render('admin.course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCourse $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            $image_root = '';
            if (!empty($data['image'])){
                $image_root = $data['image'];
                $data['image'] = urldecode($image_root);
            }
            if (!empty($data['image_pc'])){
                $data['image_pc'] = rawurldecode($data['image_pc']);
            }
            if (!empty($data['image_mobile'])){
                $data['image_mobile'] = rawurldecode($data['image_mobile']);
            }
            $model = $this->courseRepository->create($data);
            if (!empty($data['image'])){
                $this->courseRepository->saveFileUpload($image_root,$this->resizeImage,$model->id,'course');
            }
            DB::commit();
            Session::flash('success', trans('message.create_course_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_course_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->courseRepository->getOneById($id);
        return view('admin.course.update', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCourse $req)
    {
        $data_root = $this->courseRepository->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $course = $this->courseRepository->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $this->courseRepository->removeImageResize($data_root->image,$this->resizeImage, $id,'course');
                $data['image'] = $this->courseRepository->saveFileUpload($data['image'],$this->resizeImage, $id,'course');
            }
            if (!empty($data['image_pc'])){
                $data['image_pc'] = rawurldecode($data['image_pc']);
            }
            if (!empty($data['image_mobile'])){
                $data['image_mobile'] = rawurldecode($data['image_mobile']);
            }
            if (!empty($data['slug'])){
                $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            }
            $course->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_course_success'));
            return redirect()->route('admin.course.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_course_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->courseRepository->getOneById($id);

        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/course/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }
        $this->courseRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_course_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $course = $this->courseRepository->getOneById($id);
        $course->update(['active' => !$course->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_course_success')
        ];
    }
}
