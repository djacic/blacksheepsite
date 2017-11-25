<?php

namespace App\Http\Controllers\Admin;

use App\CustomCase;
use App\OrderStatus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CustomCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'cases' => CustomCase::getRepository()->findAll()
        ];
    }

    public function update(Request $request, $id)
    {
        $status = 400;
        if($request->has('status_id')) {
            try {
                $status = OrderStatus::find($request->get('status_id'));
                $case = CustomCase::getRepository()->findById($id);
                $case->order_status_id = $status->id;
                $case->save();
                $status = 200;
            } catch(QueryException $e) {
                $status = 500;
                Log::error($e->getMessage());
            } catch(\ErrorException $e) {
                $status = 422;
                Log::error($e->getMessage());
            }
        }
        return response(null, $status);
    }


}
