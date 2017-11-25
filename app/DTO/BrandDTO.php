<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 6.11.17.
 * Time: 23.21
 */

namespace App\DTO;


class BrandDTO extends ObjectDTO
{
    public $name;

    public function getModelClass()
    {
        return "App\Brand";
    }

    public function getMessages()
    {
        return [
            'name.required' => "Polje za ime brenda je obavezno.",
            'name.unique' => "Brand sa istim imenom vec postoji."
        ];
    }

    public function getRules()
    {
        return  [
            'name' => 'required|min:1|unique:brands'
        ];
    }
}