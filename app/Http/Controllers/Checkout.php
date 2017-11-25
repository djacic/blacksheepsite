<?php

namespace App\Http\Controllers;

use App\CustomCase;
use App\DTO\UserDTO;
use App\ModelManager;
use App\Order;
use App\OrderStatus;
use App\Product;
use App\Services\DTOValidator;
use App\Services\RequestToObject;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\CountValidator\Exception;

class Checkout extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has("orderItems"))
            return redirect(route("home"));
        return view('checkout');
    }

    public function buy(Request $request)
    {
        $dto = new UserDTO();
        RequestToObject::transform($dto);
        $status = true;
        try {
            $order = null;
            if($request->has('userId')) {
                $repo = User::getRepository();
                $user = $repo->findById($request->get("userId"));
                $updated = ModelManager::updateInstance($user, $dto);
                if($updated) {
                   $order = $this->browseOrderItems($user);
                }
            } else {
                //Slucaj kada se registruje novi korisnik
                $user = ModelManager::saveInstance(User::class, $dto);
                $order = $this->browseOrderItems($user);
            }

            //Slanje mail-a
            $items = session()->get("orderItems");
//            Mail::send('emails.order',
//                [ 'items' => $items,
//                    'user' => $user,
//                    'orderId' => $order ? $order->id : ""
//                ],
//                function($message) use ($user) {
//                    $message->from("lukeelukic@gmail.com", 'Blacksheep Online Shop');
//                    $message->to($user->email);
//                    $message->subject("Porudžbina");
//                });
            session()->forget('orderItems');
        } catch(\Exception $e) {
            $status = false;
            Log::error($e->getMessage());
        }
        return ['status' => $status, 'token' => $user->token];
    }

    private function browseOrderItems(User $user)
    {

            $status = OrderStatus::find(1);
            $hasProducts = false;
            $hasCustom = false;

            foreach(session()->get('orderItems') as $item) {
                if($item['type'] == 'product') {
                    $hasProducts = true;
                    break;
                }
            }

            foreach(session()->get('orderItems') as $item) {
                if($item['type'] == 'custom') {
                    $hasCustom = true;
                    break;
                }
            }

            if($hasProducts) {
                $order = new Order();
                $order->user()->associate($user);
                $order->status()->associate($status);
                $order->save();
                foreach(session()->get('orderItems') as $item)
                {

                    if($item['type'] == 'product') {
                        $order->products()->attach($item['item']->id, [
                            'amount' => $item['amount']
                        ]);
                    }
                }
                return $order;
            }

            if($hasCustom) {
                foreach(session()->get('orderItems') as $item)
                {
                    if($item['type'] == 'custom') {
                        $customCase = new CustomCase();
                        $customCase->picture_id = $item['item']->picture->id;
                        $customCase->user_id = $user->id;
                        $customCase->order_status_id = 1;
                        $customCase->amount = $item['amount'];
                        $customCase->save();
                        return $customCase;
                    }
                }

            }
        return null;

    }


}
