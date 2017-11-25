<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\DTO\ColorDTO;
use App\ModelManager;
use App\Services\DTOValidator;
use App\Services\RequestToObject;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'colors' => Color::all()
        ];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dto = new ColorDTO();
        $status = 400;
        $data = null;
        RequestToObject::transform($dto);
        $validator = new DTOValidator($dto);
        if ($validator->isValid()) {
            try {
                ModelManager::saveInstance(Color::class, $dto);
                $status = 201;
            } catch (QueryException $e) {
                Log::error($e->getMessage());
            }
        } else {
            $data = $validator->getErrors();
        }
        return response($data, $status);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $status = 404;
        $data = null;
        $model = Color::find($id);
        if($model) {
            $dto = new ColorDTO();
            RequestToObject::transform($dto);
            $validator = new DTOValidator($dto);
            if ($validator->isValid()) {
                try {
                    ModelManager::updateInstance($model, $dto);
                    $status = 201;
                } catch (QueryException $e) {
                    Log::error($e->getMessage());
                }
            } else {
                $data = $validator->getErrors();
            }
        }

        return response($data, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 404;
        $color = Color::find($id);
        if($color) {
            try {
                $result = ModelManager::deleteInstance($color);
                $status = 200;
            } catch(\PDOException $e) {
                Log::error($e->getMessage());
                $status = 500;
            }
        }
        return response(null, $status);
    }
}
