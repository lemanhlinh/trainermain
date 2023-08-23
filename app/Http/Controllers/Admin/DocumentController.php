<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use App\DataTables\DocumentDataTable;
use App\Repositories\Contracts\DocumentInterface;
use App\Http\Requests\Document\CreateDocument;
use App\Http\Requests\Document\UpdateDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    protected $documentRepository;
    protected $resizeImage;

    public function __construct(DocumentInterface $documentRepository)
    {
        $this->middleware('auth');
        $this->documentRepository = $documentRepository;
        $this->resizeImage = $this->documentRepository->resizeImage();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentDataTable $dataTable)
    {
        return $dataTable->render('admin.document.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDocument $req)
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
            $model = $this->documentRepository->create($data);
            if (!empty($data['image'])){
                $this->documentRepository->saveFileUpload($image_root,$this->resizeImage,$model->id,'document');
            }
            DB::commit();
            Session::flash('success', trans('message.create_document_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_document_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = $this->documentRepository->getOneById($id);
        return view('admin.document.update', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateDocument $req)
    {
        $data_root = $this->documentRepository->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $article = $this->documentRepository->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $this->documentRepository->removeImageResize($data_root->image,$this->resizeImage, $id,'document');
                $data['image'] = $this->documentRepository->saveFileUpload($data['image'],$this->resizeImage, $id,'document');
            }
            if (empty($data['slug'])){
                $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            }
            $article->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_document_success'));
            return redirect()->route('admin.document.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_document_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->documentRepository->getOneById($id);

        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/document/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }
        $this->documentRepository->delete($id);
        return [
            'status' => true,
            'message' => trans('message.delete_document_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $document = $this->documentRepository->getOneById($id);
        $document->update(['active' => !$document->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_document_success')
        ];
    }
}
