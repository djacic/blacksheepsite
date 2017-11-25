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

    public function getMessages()
    {
        return [];
    }
    public function getModelClass()
    {
        return CustomCase::class;
    }
    public function getRules()
    {
        return [];
    }
}