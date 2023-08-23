<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTest extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const LEVEL_VALUE_HARD = 2;
    const LEVEL_VALUE_MEDIUM = 1;
    const LEVEL_VALUE_EASY = 0;

    const LEVEL_VALUE = [
        self::LEVEL_VALUE_HARD => 'Khó',
        self::LEVEL_VALUE_MEDIUM => 'Trung bình',
        self::LEVEL_VALUE_EASY => 'Dễ',
    ];

    protected $table = 'question_test';
    protected $guarded = ['id'];

    protected $casts = [
        'active' => 'integer',
    ];

    public function questionItemTest()
    {
        return $this->hasMany(QuestionItemTest::class, 'question_id', 'id');
    }

    public function lessonTest()
    {
        return $this->belongsTo(LessonTest::class, 'lesson_id', 'id');
    }

    public function typeTest()
    {
        return $this->belongsTo(QuestionTypeTest::class, 'type_id', 'id');
    }
}
