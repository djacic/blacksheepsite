<?php

namespace App;

use App\Interfaces\Repository;
use App\Repository\TypeRepository;
use Illuminate\Database\Eloquent\Model;

class Type extends Model implements Repository
{
    public function products()
    {
        return $this->hasMany("App\Product");
    }

    public static function getRepository()
    {
        return new TypeRepository(new Type());
    }
}
