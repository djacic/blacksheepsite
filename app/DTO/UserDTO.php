<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/20/2017
 * Time: 3:10 PM
 */

namespace App\DTO;






use App\Services\RequestToObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDTO extends ObjectDTO
{
    public $firstName;
    public $lastName;
    public $email;
    public $address;
    public $phone;
    public $city;
    public $postNumber;
    public $token;

    public function __construct()
    {
        $this->token = $this->generateRandomString();
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getModelClass()
    {
        return "App\User";
    }

    public function getMessages()
    {
        return [];
    }

    public function getRules()
    {
        return  [
            'firstName' => 'required|max:30|min:3',
            'lastName' => 'required|min:3|max:30',
            'email' => 'required|email',
            'address' => 'required|max:70',
            'phone' => 'required|min:11|max:12',
            'city' => 'required|min:2',
            'postNumber' => 'required|numeric|min:5',
            'token' => 'required'
        ];
    }

}