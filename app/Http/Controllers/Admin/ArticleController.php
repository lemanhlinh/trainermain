<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ArticleDataTable;
use App\Repositories\Contracts\ArticleInterface;
use App\Http\Requests\Article\CreateArticle;
use App\Http\Requests\Article\UpdateArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $articleRepository;
    protected $resizeImage;

    public function __construct(ArticleInterface $articleRepository)
    {
        $this->middleware('auth');
        $this->articleRepository = $articleRepository;
        $this->resizeImage = $this->articleRepository->resizeImage();
    }

    /**
     * Display a listing of the resource.
     *
     * @param ArticleDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleDataTable $dataTable)
    {
        return $dataTable->render('admin.article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticle $req
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticle $req)
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
            $model = $this->articleRepository->create($data);
            if (!empty($data['image'])){
                $this->articleRepository->saveFileUpload($image_root,$this->resizeImage,$model->id,'article');
            }
            DB::commit();
            Session::flash('success', trans('message.create_article_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_article_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->getOneById($id);
        return view('admin.article.update', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateArticle  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateArticle $req)
    {
        $data_root = $this->articleRepository->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $article = $this->articleRepository->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $this->articleRepository->removeImageResize($data_root->image,$this->resizeImage, $id,'article');
                $data['image'] = $this->articleRepository->saveFileUpload($data['image'],$this->resizeImage, $id,'article');
            }
            if (empty($data['slug'])){
                $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            }
            $article->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_article_success'));
            return redirect()->route('admin.article.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_article_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->articleRepository->getOneById($id);

        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/article/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }
        $this->articleRepository->delete($id);
        return [
            'status' => true,
            'message' => trans('message.delete_article_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $article = $this->articleRepository->getOneById($id);
        $article->update(['active' => !$article->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_article_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeIsHome($id)
    {
        $article = $this->articleRepository->getOneById($id);
        $article->update(['is_home' => !$article->is_home]);
        return [
            'status' => true,
            'message' => trans('message.change_is_home_article_success')
        ];
    }
}
