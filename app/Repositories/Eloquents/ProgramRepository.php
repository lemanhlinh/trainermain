<?php

namespace App\Repositories\Eloquents;

use App\Models\Program;
use App\Repositories\Contracts\ProgramInterface;

class ProgramRepository extends BaseRepository implements ProgramInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Program';
    }
}
