<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/21/2017
 * Time: 3:31 PM
 */

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

class UserRepository extends AbstractRepository
{
    /**
     * UserRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function findByToken($token)
    {
        return $this->model->where('token', $token)->get();
    }

}