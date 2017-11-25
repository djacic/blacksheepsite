<?php

use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 100; $i++) {
            $price = new App\Price();
            $price->product_id = rand(1,30);
            $price->price = rand(100,3000);
            $price->save();
        }
    }
}
