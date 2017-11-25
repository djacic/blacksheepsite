<?php

/**
 * Created by PhpStorm.
 * User: luke
 * Date: 4.11.17.
 * Time: 23.53
 */
class PicturesTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $picture = new App\Picture();
        $picture->file = "p4.jpg";
        $picture->alt = "Slika";
        $picture->save();
    }
}
