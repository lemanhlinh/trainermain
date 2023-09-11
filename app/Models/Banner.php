<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $guarded = ['id'];

    protected $appends = [
        'image_resize',
    ];

    protected $casts = [
        'active' => 'integer',
    ];

    public function getImageResizeAttribute()
    {
        $img_path = pathinfo($this->image, PATHINFO_DIRNAME);
        $array_resize_ = str_replace($img_path.'/','/storage/banner/'.$this->id.'-',$this->image);
        $array_resize = str_ireplace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
        return $array_resize;
    }
}
