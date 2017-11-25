<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 5.11.17.
 * Time: 23.40
 */

namespace App\Repository;


use App\Brand;
use App\Type;

class TypeRepository extends AbstractRepository
{
    public function __construct(Type $model)
    {
        parent::__construct($model);
    }
    
}