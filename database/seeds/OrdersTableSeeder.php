<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('orders')->delete();

        DB::table('orders')->insert([
            [
                'snack_id' => 2,
                'status' => 'SUCCESS',
                'price' => 3.5,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'snack_id' => 2,
                'status' => 'SUCCESS',
                'price' => 5.0,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],

        ]);
    }
}
