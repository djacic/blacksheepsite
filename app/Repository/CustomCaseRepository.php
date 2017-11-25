<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 7.11.17.
 * Time: 14.03
 */

namespace App\Repository;


use App\Http\Controllers\CustomCase;
use App\Interfaces\Repository;

class CustomCaseRepository extends AbstractRepository
{
    public function __construct(\App\CustomCase $model)
    {
        parent::__construct($model);
    }

    public function findAll()
    {
        return $this->model->with(
            [
               'user','picture','status'
            ])->get();
    }
}