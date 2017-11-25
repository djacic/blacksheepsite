<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/21/2017
 * Time: 11:34 PM
 */

namespace App\Services;


use Illuminate\Http\Request;

class RequestToObject
{
    public static function transform($object)
    {
        $request = Request::createFromGlobals();
        foreach(get_object_vars($object) as $key => $value) {
            if($request->has($key)) {
                $object->$key = $request->get($key);
            }
        }
        return $object;

    }
}