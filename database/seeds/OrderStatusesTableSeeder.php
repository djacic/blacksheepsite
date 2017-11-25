<?php

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderStatus = new App\OrderStatus();
        $orderStatus->name = "Na čekanju.";
        $orderStatus->save();

        $orderStatus = new App\OrderStatus();
        $orderStatus->name = "Porudzbina poslata.";
        $orderStatus->save();

        $orderStatus = new App\OrderStatus();
        $orderStatus->name = "Porudzbina dostavljena";
        $orderStatus->save();
    }
}
