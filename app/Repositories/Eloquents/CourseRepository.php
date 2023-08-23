<?php

namespace App\Repositories\Eloquents;

use App\Models\Course;
use App\Repositories\Contracts\CourseInterface;

class CourseRepository extends BaseRepository implements CourseInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Course';
    }
}
