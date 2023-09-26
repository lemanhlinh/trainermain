<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\BaseInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

abstract class BaseRepository implements BaseInterface
{
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    public abstract function getModelClass(): string;

    /**
     * @param int $id
     * @param array $relationships
     * @return mixed
     */
    public function getOneById(int $id, array $relationships = [])
    {
        return $this->model->with($relationships)->findOrFail($id);
    }

    /**
     * @param array $ids
     * @return \Illuminate\Support\Collection
     */
    public function getByIds(array $ids): Collection
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->model->whereId($id)->update($attributes);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param int $limit
     * @param array $columns
     * @param array $relationships
     * @return mixed
     */
    public function paginate(int $limit, array $columns = ['*'], array $where = [], array $relationships = [])
    {
        return $this->model->select($columns)->where($where)->latest()->with($relationships)->paginate($limit ?? config('data.limit', 20));
    }

    /**
     * @param array $where
     * @param array $columns
     * @param array $relationships
     * @param int $limit
     * @return mixed
     */
    public function getList(array $where, array $columns = ['*'], int $limit, array $relationships = [])
    {
        $query = $this->model->select($columns);

        if($where){
            foreach($where as $key => $value){
                if (gettype($value) === 'array'){
                    $query->where($key, $value[0], $value[1]);
                }else{
                    $query->where($key, $value);
                }

            }
        }
        if (!empty($limit)){
            $query->limit($limit);
        }

        if ($limit == 1){
            return $query->with($relationships)->first();
        }

        return $query->with($relationships)->orderBy('id', 'DESC')->get();
    }

    /**
     * @return Collection
     */
    public function getWithDepth() : Collection
    {
        return $this->model->withDepth()->defaultOrder()->get();
    }

    /**
     * @return mixed
     */
    public function resizeImage()
    {
        return $this->model->resizeImage;
    }

    /**
     * @param $file
     * @param $resizeImage
     * @param $id
     * @param $nameModule
     * @return string
     */
    public function removeImageResize(string $file,array $resizeImage = null,int $id = null, string $nameModule)
    {
        $img_path = pathinfo($file, PATHINFO_DIRNAME);
        if (!empty($resizeImage) && !empty($id)){
            foreach ($resizeImage as $item){
                $array_resize_ = str_replace($img_path.'/','/public/'.$nameModule.'/'.$item[0].'x'.$item[1].'/'.$id.'-',$file);
                $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
                Storage::delete($array_resize_);
            }
        }
        return true;
    }

    /**
     * @param $file
     * @param $resizeImage
     * @param $id
     * @param string $nameModule
     * @param string $styleResize
     * @return string
     */
    public function saveFileUpload(string $file,array $resizeImage = null,int $id = null, string $nameModule, string $styleResize = null)
    {
        $fileNameWithoutExtension = urldecode(pathinfo($file, PATHINFO_FILENAME));
        $fileName = $fileNameWithoutExtension. '.webp';

        if (!empty($resizeImage) && !empty($id)){
            foreach ($resizeImage as $item){
                if ($styleResize){
                    $thumbnail = Image::make(asset($file))->resize($item[0], null,function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('webp', 75);
                }else{
                    $thumbnail = Image::make(asset($file))->fit($item[0], $item[1])->encode('webp', 75);
                }
                $thumbnailPath = 'storage/'.$nameModule.'/'.$item[0].'x'.$item[1].'/' .$id.'-'. $fileName;
                Storage::makeDirectory('public/'.$nameModule.'/'.$item[0].'x'.$item[1].'/');
                $thumbnail->save($thumbnailPath);
            }
        }

        return urldecode($file);
    }
}
