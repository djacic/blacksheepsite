<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 2.11.17.
 * Time: 02.29
 */

namespace App\DTO;


class CategoryDTO extends ObjectDTO
{
    public $name;

    public function getModelClass()
    {
        return "App\Category";
    }

    public function getMessages()
    {
        return [
            'name.required' => 'Polje za ime kategorije je obavezno.',
            'name.unique' => "Kategorija sa istim imenom vec postoji."
        ];
    }

    public function getRules()
    {
        return  [
            'name' => 'required|min:1|unique:categories'
        ];
    }
}