<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
                'role_id'=>'1',
                'remember_token' => Str::random(10),
                'created_at' =>now(),
                'updated_at' =>now()           
        ]);

    }
}

