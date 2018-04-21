<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::create(
                 [
                    'name' => 'Danny Yoh',
                    'email' => 'admin@danny.com',
                    'phone_number' => '09876543211',
                    'role' => 1,
                    'password' => Hash::make('asd123'),
                ]
        );
    }
}
