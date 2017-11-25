<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 11.11.17.
 * Time: 22.01
 */

namespace App\DTO;


class ProductDTO extends ObjectDTO
{
    public $file;
    public $alt = "alt tag";
    public $colors;
    public $description;
    public $is_active;
    public $is_offer;
    public $price;
    public $special;
    public $type_id;
    public $brand_id;
    public $name;

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
            //'file' => 'required|image|max:2000',
            'colors' => 'required',
            'price' => 'required|numeric',
            'type_id' => 'numeric',
            'brand_id' => 'numeric',
            'description' => 'required',
            'name' => 'required'
        ];
    }
}