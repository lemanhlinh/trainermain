<?php

namespace App\Repositories\Eloquents;

use App\Models\QuestionTest;
use App\Repositories\Contracts\QuestionTestInterface;

class QuestionTestRepository extends BaseRepository implements QuestionTestInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\QuestionTest';
    }
}
