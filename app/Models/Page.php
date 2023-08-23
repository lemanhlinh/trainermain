<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
//    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'integer',
    ];
}
