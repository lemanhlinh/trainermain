<?php

namespace App\Repositories\Eloquents;

use App\Models\MenuCategory;
use App\Repositories\Contracts\MenuCategoryInterface;

class MenuCategoryRepository extends BaseRepository implements MenuCategoryInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\MenuCategory';
    }
}
