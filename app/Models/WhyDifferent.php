<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyDifferent extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const STATUS_SHOW_HOME = 0; //trang chủ
    const STATUS_SHOW_CAT = 1; // trang khóa học


    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'integer',
        'is_home' => 'integer',
    ];
}
