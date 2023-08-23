<?php

namespace App\Repositories\Eloquents;

use App\Models\QuestionTypeTest;
use App\Repositories\Contracts\QuestionTypeTestInterface;

class QuestionTypeTestRepository extends BaseRepository implements QuestionTypeTestInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\QuestionTypeTest';
    }
}
