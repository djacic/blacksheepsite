<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/21/2017
 * Time: 7:57 PM
 */

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

class AdminRepository extends AbstractRepository
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * @param String $username
     * @param String $password
     */
    public function login(String $username, String $password)
    {
        $user = $this->model->where('username', $username)->get()[0];
        if($user) {
            return password_verify($password, $user->password);
        }
        return false;
    }
}