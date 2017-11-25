<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/22/2017
 * Time: 12:21 PM
 */

namespace App\Services;


use App\DTO\ObjectDTO;
use Illuminate\Support\Facades\Validator;

class DTOValidator
{
    private $errors;
    private $dto;

    public function __construct(ObjectDTO $dto)
    {
        $this->dto = $dto;
    }

    public function isValid()
    {
        $validator = Validator::make(get_object_vars($this->dto), $this->dto->getRules(), $this->dto->getMessages());
        $this->errors = $validator->errors()->messages();
        return count($this->errors) == 0;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getDto(){
        return $this->dto;
    }
}