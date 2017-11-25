<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 6.11.17.
 * Time: 23.22
 */

namespace App\DTO;


class TypeDTO extends ObjectDTO
{
    public $name;

    public function getModelClass()
    {
        return "App\Type";
    }

    public function getMessages()
    {
        return [
            'name.required' => 'Polje za ime tipa je obavezno.',
            'name.unique' => "Tip sa istim imenom vec postoji."
        ];
    }

    public function getRules()
    {
        return  [
            'name' => 'required|min:1|unique:types'
        ];
    }
}