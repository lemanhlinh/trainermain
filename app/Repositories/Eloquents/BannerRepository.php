<?php

namespace App\Repositories\Eloquents;

use App\Models\Banner;
use App\Repositories\Contracts\BannerInterface;

class BannerRepository extends BaseRepository implements BannerInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Banner';
    }

}
