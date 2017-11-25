<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\DTO\BrandDTO;
use App\DTO\CategoryDTO;
use App\DTO\TypeDTO;
use App\ModelManager;
use App\ProductCategory;
use App\Repository\CategoryRepository;
use App\Services\DTOValidator;
use App\Services\RequestToObject;
use App\Type;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'categories' => Category::getRepository()->allWithBrands(),
            'brands' => Brand::getRepository()->findAll(),
            'types' => Type::getRepository()->findAll()
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
        //Response ako nema tipa kategorije
        $status = 422;
        $data = null;

        //Ako je prosledjen tip kategorije, pravi se jedna od 3 hijerarhijske kategorije (Brand, Kategorija ili Tip)
        if ($request->has('type')) {
                switch ($request->get('type')) {
                    case 'brand':
                        $dto = new BrandDTO();
                        break;
                    case 'category':
                        $dto = new CategoryDTO();
                        break;
                    case 'type':
                        $dto = new TypeDTO();
                        break;
                }
            RequestToObject::transform($dto);
            $validator = new DTOValidator($dto);
            if($validator->isValid()) {
                $model = $obj = ModelManager::saveInstance($dto->getModelClass(), $dto);
                if($model) {
                    $data = null;
                    $status = 201;
                } else {
                    $data = null;
                    $status = 500;
                }

            } else {
                $data['errors'] = $validator->getErrors();
                $status = 400;
            }
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
        //Response ako nema tipa kategorije
        $status = 422;
        $data = null;
        $model = null;
        $dto = null;
        //Ako je prosledjen tip kategorije, pravi se jedna od 3 hijerarhijske kategorije (Brand, Kategorija ili Tip)
        if ($request->has('type')) {
            switch ($request->get('type')) {
                case 'brand':
                    $dto = new BrandDTO();
                    $model = Brand::getRepository()->findById($id);
                    break;
                case 'category':
                    $dto = new CategoryDTO();
                    $model = Category::getRepository()->findById($id);
                    if ($request->has("brands")) {
                       $model->brands()->sync($request->get("brands"));
                    }
                    break;
                case 'type':
                    $dto = new TypeDTO();
                    $model = Type::getRepository()->findById($id);
                    break;
            }
            RequestToObject::transform($dto);
            $validator = new DTOValidator($dto);
            if($validator->isValid()) {
                $result = ModelManager::updateInstance($model, $dto);
                if($result) {
                    $status = 204;
                } else {
                    $status = 500;
                }
            } else {
                $data['errors'] = $validator->getErrors();
                $status = 400;
            }
        }
        return response($data, $status);
    }


    public function destroy(Request $request, $id)
    {
        $status = 404;
        $model = null;
        //Ako je prosledjen tip kategorije, pravi se jedna od 3 hijerarhijske kategorije (Brand, Kategorija ili Tip)
        if ($request->has('type')) {
            switch ($request->get('type')) {
                case 'brand':
                    $model = Brand::getRepository()->findById($id);
                    break;
                case 'category':
                    $model = Category::getRepository()->findById($id);
                    break;
                case 'type':
                    $model = Type::getRepository()->findById($id);
                    break;
            }
            if ($model) {
                try {
                    $result = ModelManager::deleteInstance($model);
                    $status = 200;
                } catch (QueryException $e) {
                    Log::error($e->getMessage());
                    $status = 409;
                }
            }
        }
        return response(null, $status);
    }
}
