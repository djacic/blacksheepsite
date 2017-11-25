<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/20/2017
 * Time: 3:23 PM
 */

namespace App\DTO;



use Illuminate\Http\Request;

abstract class ObjectDTO
{
    public abstract function getModelClass();
    public abstract function getRules();
    public abstract function getMessages();
}