<?php

namespace App\Http\Controllers;

use App\DTO\CustomCaseDTO;
use App\DTO\PictureDTO;
use App\ModelManager;
use App\OrderStatus;
use App\Picture;
use App\Services\DTOValidator;
use App\Services\RequestToObject;
use App\User;
use Illuminate\Http\Request;

class CustomCase extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('custom_case');
    }

    public function add(Request $request)
    {
        if ($request->has("add")) {
           $dto = new CustomCaseDTO();
           RequestToObject::transform($dto);
           $pictureDTO = new PictureDTO();
           $pictureDTO->file = $request->file("file");
           $validator = new DTOValidator($pictureDTO);
           if(!$validator->isValid()) {
                return redirect()->back()->with('errors', $validator->getErrors());
           } else {
               $fileName = $request->file('file')->getFilename() . "_" . mktime(time()) . "." . $request->file('file')->extension();
               $pictureDTO->file = $fileName;
               $picture = new Picture();
               $picture->alt = "custom case";
               $picture->file = $fileName;
               $picture->save();
               $request->file('file')->move(base_path("/public/assets/pages/img/products/"), $fileName);

                $this->addToCart($picture);
               
               return redirect()->back()->with("success", "Proizvod uspešno dodat u korpu.");
           }
        }
    }

    private function addToCart(Picture $picture)
    {
        $item = new \stdClass();
        $item->name = "Custom case maska";
        $id = 1;
        if(session()->has('orderItems')) {
            foreach(session()->get("orderItems") as $orderItem) {
                if($orderItem['type'] == 'custom') $id++;
            }
        }

        $item->id = "custom" . $id;
        $item->picture = $picture;
        $price = new \stdClass();
        $price->price = 300;
        $item->prices = [$price];
        $item->description = "Maska na osnovu slike unete u formi.";
        if(!session('orderItems')) {
            session(['orderItems' => [
                [
                    'item' => $item,
                    'amount' => 1,
                    'type' => "custom"
                ]
            ]]);
        } else {
                session()->push('orderItems',
                    [
                        'item' => $item,
                        'amount' => 1,
                        'type' => "product"
                    ]);
        }

    }

    //Verovatno se obradjuje na drugom mestu, da se sacuva kod ovde
    private function checkout(Picture $picture)
    {
        $user = User::getRepository()->findById(1);
        $order_status = OrderStatus::find(1);

        $custom_case = new \App\CustomCase();
        $custom_case->user()->associate($user);
        $custom_case->order_status_id = $order_status->id;
        $custom_case->picture_id = $picture->id;
        $custom_case->save();
    }
}
