<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/21/2017
 * Time: 2:17 PM
 * Klasa za upravljanje modelima.
 * saveInstance - pravi instacu modela na osnovu imena klase i DTO-a i cuva ga u bazi
 * updateInstance - menja vrednosti modela na osnovu DTO-a i cuva izmene u bazi
 * deleteInstance - brise zapis iz baze koji odgovara prosledjenom modelu
 *
 */

namespace App;


use App\DTO\ObjectDTO;
use App\Services\DTOValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ModelManager
{
    /**
     * @param $className
     * @param ObjectDTO $dto
     * @return Model|null
     */
    public static function saveInstance($className, ObjectDTO $dto)
    {
        $model = null;
        $validator = new DTOValidator($dto);
        if(ModelManager::isCompatible($className, $dto)){
            if($validator->isValid()) {
                $model = new $className;
                foreach($dto as $key => $value) {
                    $model->$key = $value;
                }
                $model->save();
            }
        }
        return $model;
    }

    /**
     * @param Model $model
     * @param ObjectDTO $dto
     * @return Model|null
     */
    public static function updateInstance(Model $model, ObjectDTO $dto)
    {
        $updated = null;
        $validator = new DTOValidator($dto);
        if(get_class($model) == $dto->getModelClass()) {
            if($validator->isValid()) {
                foreach($dto as $key => $value) {
                    $model->$key = $value;
                }
                $model->save();
                $updated = $model;
            }
        }
        return $updated;
    }

    /**
     * @param Model $model
     * @return bool|null
     */
    public static function deleteInstance(Model $model)
    {
        $deleted = $model->delete();
        return $deleted;
    }


    /**
     * @param $class
     * @param ObjectDTO $dto
     * @return bool
     */
    private static function isCompatible($class, ObjectDTO $dto)
    {
        return $class == $dto->getModelClass();
    }
}