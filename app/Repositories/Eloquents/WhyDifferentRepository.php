<?php

namespace App\Repositories\Eloquents;

use App\Models\WhyDifferent;
use App\Repositories\Contracts\WhyDifferentInterface;

class WhyDifferentRepository extends BaseRepository implements WhyDifferentInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\WhyDifferent';
    }
}
