<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 2.11.17.
 * Time: 02.29
 */

namespace App\DTO;


class ColorDTO extends ObjectDTO
{
    public $hex;

    public function getModelClass()
    {
        return "App\Color";
    }

    public function getMessages()
    {
        return [
        'hex.required' => "Boja nije odabrana.",
        'hex.hexcolor' => "Boja mora biti u heksadecimalnom formatu.",
        'hex.unique' => "Odabrana boja vec postoji."
    ];
    }

    public function getRules()
    {
        return  [
            'hex' => 'required|hexcolor|unique:colors',
        ];
    }
}