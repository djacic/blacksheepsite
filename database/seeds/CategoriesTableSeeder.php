<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 1; $i < 10; $i++) {
            $category = new App\Category();
            $category->name = "Category" . $i;
            $category->save();
        }
    }
}
