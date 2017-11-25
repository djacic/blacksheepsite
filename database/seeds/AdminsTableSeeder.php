<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new App\Admin();
        $admin->username = "luke";
        $admin->password = password_hash('sifra1', PASSWORD_BCRYPT);
        $admin->save();

        $admin = new App\Admin();
        $admin->username = "djakon";
        $admin->password = password_hash("sifra1", PASSWORD_BCRYPT);
        $admin->save();
    }
}
