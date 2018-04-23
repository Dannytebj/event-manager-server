<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = array('AVAILABLE', 'BOOKED');
        for ($i = 0; $i < 2; $i++){
            DB::table('status')->insert([
                'type' => $status[$i]
            ]);
        }
    }
}
