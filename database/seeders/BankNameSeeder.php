<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use App\Models\BankDetails;

class BankNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        BankDetails::insert([
            [                
                'id' => Uuid::uuid4(),
                'bank_name' => 'HDFC Bank',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'bank_name' => 'Canara Bank',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'bank_name' => 'Indian Bank',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'bank_name' => 'Indian Overseas Bank',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'bank_name' => 'State Bank of India',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'bank_name' => 'Axis Bank',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'bank_name' => 'City Union Bank',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'bank_name' => 'Karur Vysya Bank',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
            [ 
                'id' => Uuid::uuid4(),
                'bank_name' => 'ICICI Bank',
                'status' => 1,
                'created_at' =>now(),
                'updated_at' =>now(),
            ],
        ]);
    }
}
