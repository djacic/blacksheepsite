<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PicturesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(DeliveryPricesTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(PriceTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
    }
}
