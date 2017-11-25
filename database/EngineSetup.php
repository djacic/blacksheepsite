<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/19/2017
 * Time: 7:29 PM
 */

class EngineSetup
{
    public static function engine(\Illuminate\Database\Schema\Blueprint $table) {
        $table->engine = "engine";
    }
}