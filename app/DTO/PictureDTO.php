<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 7.11.17.
 * Time: 12.09
 */

namespace App\DTO;


use App\Picture;

class PictureDTO extends ObjectDTO
{
    public $file;
    public $alt = "alt tag";

    public function getMessages()
    {
        return [
            'file.required' => "Morate odabrati sliku za upload.",
            'file.image' => "Format slike nije podrzan. Molimo vas prilozite jpeg ili png sliku.",
            'file.max' => "Slika mora biti manja od 2mb"
        ];
    }
    public function getModelClass()
    {
        return Picture::class;
    }
    public function getRules()
    {
        return [
            'file' => 'required|image|max:2000'
        ];
    }
}