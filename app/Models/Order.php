<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_WAITING = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_CANCEL = 2;

    protected $guarded= ['id'];

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class, 'order_id', 'id');
    }
}
