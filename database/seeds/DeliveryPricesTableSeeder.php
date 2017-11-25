<?php

use Illuminate\Database\Seeder;

class DeliveryPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryPrice = new App\DeliveryPrice();
        $deliveryPrice->price = 350;
        $deliveryPrice->save();
    }
}
