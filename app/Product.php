<?php

namespace App;

use App\Interfaces\Repository;
use App\Repository\ProductRepository;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Repository
{

    public function brand()
    {
        return $this->belongsTo("App\Brand");
    }

    public function type()
    {
        return $this->belongsTo("App\Type");
    }
    public function prices()
    {
        return $this->hasMany("App\Price");
    }

    public function colors()
    {
        return $this->belongsToMany("App\Color", "product_color");
    }

    public function picture()
    {
        return $this->hasOne("App\Picture", 'id', 'picture_id');
    }

    public static function getRepository()
    {
        return new ProductRepository(new Product());
    }
}
