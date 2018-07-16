<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('managers')->delete();

        DB::table('managers')->insert([
            [
                'id'=>'1',
                'name'=>'Manager',
                'email'=>'manager@gmail.com',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
        ]);
    }
}
