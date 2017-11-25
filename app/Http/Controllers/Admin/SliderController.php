<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 11/23/2017
 * Time: 8:18 PM
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Mockery\Exception;

class SliderController
{
    public function changePicture(Request $request, $id)
    {
        $status = 200;
        try {
            $fileName = $id.".".$request->file('picture')->extension();
            $request->file('picture')->move(base_path("/public/assets/pages/img/shop-slider/slide/"), $fileName);
            \DB::table("slider")
                ->where('id', $id)
                ->update(['file' => $fileName]);
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            $status = 500;
        }
        return response(null, $status);
    }
}
