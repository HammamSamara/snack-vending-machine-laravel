<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SnacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('snacks')->delete();

        DB::table('snacks')->insert([
            [
                'name' => 'M&Ms',
                'code' => 'A1',
                'price' => 3.5,
                'quantity' => 5,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'Hershey\'s',
                'code' => 'B2',
                'price' => 5.0,
                'quantity' => 8,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'Mars',
                'code' => 'C3',
                'price' => 3.5,
                'quantity' => 6,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'Milky Way',
                'code' => 'D4',
                'price' => 4,
                'quantity' => 5,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'Cadbury',
                'code' => 'D6',
                'price' => 2.0,
                'quantity' => 2,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
              ],
            [
                'name' => 'Twix',
                'code' => 'D7',
                'price' => 3.5,
                'quantity' => 1,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'Snickers',
                'code' => 'E4',
                'price' => 3.5,
                'quantity' => 8,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'Cola',
                'code' => 'B6',
                'price' => 3.5,
                'quantity' => 0,
                'is_available' => 0,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],

        ]);
    }
}
