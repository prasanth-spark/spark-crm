<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use App\Models\AccountType;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::insert([
            [                
                'id' => Uuid::uuid4(),
                'account_type' => 'savings account',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'account_type' => 'current account',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
        ]);  
      }
}
