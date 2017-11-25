<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 30; $i++) {
            $product = new App\Product();
            $product->name = "Product" . $i;
            $product->description = $faker->text(100);
            $product->brand_id = rand(1, 9);
            $product->picture_id = 1;
            $product->save();
        }
    }
}
