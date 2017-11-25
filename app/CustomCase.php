<?php

namespace App;

use App\Interfaces\Repository;
use App\Repository\CustomCaseRepository;
use Illuminate\Database\Eloquent\Model;

class CustomCase extends Model implements Repository
{
    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function picture()
    {
        return $this->hasOne("App\Picture", "id", "picture_id");
    }

    public function status()
    {
        return $this->hasOne("App\OrderStatus", "id", "order_status_id");
    }

    public static function getRepository()
    {
        return new CustomCaseRepository(new CustomCase());
    }
}
