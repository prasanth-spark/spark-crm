<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        \App\Models\User::updateOrCreate(
            [ 
                'id'=>'uuid',
                'name' => 'sparkouttech',
                'email' => 'admin@sparkouttech.com', 
                'email_verified_at' => now(),
                'password' => Hash::make('12345'), // password
                'gender' => 'male',
                'active'=>'2',
                'remember_token' => Str::random(10),
                'created_at' =>now(),
                'updated_at' =>now()           
        ]);

    }
}

