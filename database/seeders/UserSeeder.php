<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [ 
                'id' => Uuid::uuid(),
                'name' => 'sparkouttech',
                'email' => 'admin@sparkouttech.com', 
                'email_verified_at' => now(),
                'password' => Hash::make('12345'), // password
                'status'=>'0',
                'remember_token' => Str::random(10),
                'created_at' =>now(),
                'updated_at' =>now()           
        ]);

    }
}

