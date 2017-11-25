<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'orders' => Order::getRepository()->newOrders()
        ];
    }

    public function update(Request $request, $id)
    {
        $order = Order::getRepository()->findById($id);
        $status = 404;
        if ($order) {
           if(!$request->has("statusId")) {
               $status = 422;
           } else {
                try {
                    if($request->has('removedItems')) {
                        foreach($request->get("removedItems") as $product_id) {
                            $order->products()->detach($product_id);
                        }
                    }
                    $order->status_id = $request->get("statusId");
                    $order->save();
                    $status = 200;
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                    $status = 500;
                }
           }
        }
        return response(null, $status);
    }
    
}
