<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/21/2017
 * Time: 1:48 PM
 */

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function findById($id) {
        return $this->model->find($id);
    }
}