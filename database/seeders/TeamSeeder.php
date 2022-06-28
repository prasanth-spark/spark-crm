<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamModel;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeamModel::insert([
            [ 'id' => '1',
                'team' => 'HR',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 'id' => '2',
                'team' => 'PHP',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '3',
                'team' => 'JS',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '4',
                'team' => 'IOS',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '5',
                'team' => 'TESTING',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '6',
                'team' => 'ANDROID',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],[ 
                'id' => '7',
                'team' => 'DevOps',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],[ 
                'id' => '8',
                'team' => 'MARKETING',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '9',
                'team' => 'INTERNSHIP',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ],
            [ 
                'id' => '10',
                'team' => 'MANAGMENT',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
            ]

        ]);
    }
}
