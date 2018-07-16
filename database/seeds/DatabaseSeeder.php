<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(VendingMachineSeeder::class);
        $this->call(SnacksTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(ManagerTableSeeder::class);


    }
}
