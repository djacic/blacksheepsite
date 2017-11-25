<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 1; $i < 7; $i++) {
            $color = new App\Color();
            $color->hex = $faker->hexColor;
            $color->save();
        }
    }
}
