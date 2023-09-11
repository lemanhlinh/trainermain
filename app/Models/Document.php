<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $appends = [
        'created_at_format',
        'image_resize',
    ];

    public $resizeImage = ['resize'=>[400,225],'small'=>[140,80]];

    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'integer',
    ];

    protected $table = 'document';


    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y H:i');
    }

    public function getImageResizeAttribute()
    {
        $img_path = pathinfo($this->image, PATHINFO_DIRNAME);
        $array_resize = array();
        $resizeImage = $this->resizeImage;
        foreach ($resizeImage as $k => $item){
            $array_resize_ = str_replace($img_path.'/','/storage/document/'.$item[0].'x'.$item[1].'/'.$this->id.'-',$this->image);
            $array_resize[$k] = str_ireplace(['.jpg', '.png','.bmp','.gif','.jpeg','.PNG'],'.webp',$array_resize_);
        }
        return $array_resize;
    }
}
