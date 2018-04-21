<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = array('ADMIN', 'REGULAR');
        for ($i = 0; $i < 2; $i++){
           DB::table('role')->insert([
               'name' => $userRoles[$i]
           ]);
        }
    }
}
