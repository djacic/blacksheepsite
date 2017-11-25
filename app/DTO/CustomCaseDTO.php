<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 7.11.17.
 * Time: 11.59
 */

namespace App\DTO;


use App\CustomCase;

class CustomCaseDTO extends ObjectDTO
{
    public $comment;
    public $model;

    public function getMessages()
    {
        return [
          'model.required'=>'Upišite model telefona'
        ];
    }
    public function getModelClass()
    {
        return CustomCase::class;
    }
    public function getRules()
    {
      return  [
          'model' => 'required'
      ];
    }
}
