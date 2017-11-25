<?php

namespace App;

use App\Interfaces\Repository;
use App\Repository\OrderRepository;
use Illuminate\Database\Eloquent\Model;

class Order extends Model implements Repository
{
    public function status()
    {
        return $this->belongsTo("App\OrderStatus");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function products()
    {
        return $this->belongsToMany("App\Product", "order_product")->withPivot('created_at', 'updated_at', 'amount');
    }

    public static function getRepository()
    {
        return new OrderRepository(new Order());
    }
}
