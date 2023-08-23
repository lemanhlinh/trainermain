<?php

namespace App\Repositories\Eloquents;

use App\Models\MemberTest;
use App\Repositories\Contracts\MemberTestInterface;

class MemberTestRepository extends BaseRepository implements MemberTestInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\MemberTest';
    }
}
