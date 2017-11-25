<?php

namespace App;

use App\Interfaces\Repository;
use App\Repository\BrandRepository;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model implements Repository
{
    public function products()
    {
        return $this->hasMany("App\Product");
    }

    public static function getRepository()
    {
        return new BrandRepository(new Brand());
    }
}
