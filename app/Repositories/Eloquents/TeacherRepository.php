<?php

namespace App\Repositories\Eloquents;

use App\Models\Teacher;
use App\Repositories\Contracts\TeacherInterface;

class TeacherRepository extends BaseRepository implements TeacherInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Teacher';
    }
}
