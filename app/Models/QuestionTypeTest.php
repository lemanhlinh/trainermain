<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTypeTest extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    protected $table = 'question_type_test';
    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'integer',
    ];
}
