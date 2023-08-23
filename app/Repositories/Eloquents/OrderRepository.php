<?php

namespace App\Repositories\Eloquents;

use App\Models\Order;
use App\Repositories\Contracts\OrderInterface;

class OrderRepository extends BaseRepository implements OrderInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Order';
    }
}
