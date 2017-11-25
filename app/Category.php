<?php

namespace App;

use App\Interfaces\Repository;
use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements Repository
{

    public function brands()
    {
        return $this->belongsToMany("App\Brand", "category_brand");
    }

    public static function getRepository()
    {
        return new CategoryRepository(new Category());
    }


}
