<?php

namespace App\Repositories\Eloquents;

use App\Models\LessonTest;
use App\Repositories\Contracts\LessonTestInterface;

class LessonTestRepository extends BaseRepository implements LessonTestInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\LessonTest';
    }
}
