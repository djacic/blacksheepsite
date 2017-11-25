<?php

namespace App;

use App\Interfaces\Repository;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Repository
{
    public function customCases()
    {
        return $this->hasMany("App\CustomCase");
    }

    public function orders()
    {
        return $this->hasMany("App\Order");
    }

    public static function getRepository()
    {
        return new UserRepository(new User());
    }
}
