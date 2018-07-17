<?php

use Illuminate\Database\Seeder;

class VendingMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('vending_machines')->delete();

        DB::table('vending_machines')->insert([
            [
                'id'=>'1',
                'available_change' => 80.0,
                'dispensed_change' => 0.0,
                'inserted_money' => 0.0,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
        ]);
    }
}
