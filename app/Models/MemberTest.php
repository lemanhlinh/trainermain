<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTest extends Model
{
    protected $guarded = ['id'];
    protected $table = 'member_test';

    public function lessonTest()
    {
        return $this->belongsTo(LessonTest::class, 'lesson_id', 'id');
    }

}
