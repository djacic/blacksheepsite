<?php

namespace App;

use App\Interfaces\Repository;
use App\Repository\AdminRepository;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Repository
{
    public static function getRepository()
    {
        return new AdminRepository(new Admin());
    }
}
