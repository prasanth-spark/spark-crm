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
            [ 
                'id' => '1',
                'team' => 'PHP',
                'status'=>'1',
                'created_at' =>now(),
                'updated_at' =>now()           
        ],
        [ 
            'id' => '2',
            'team' => 'JS',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],
        [ 
        'id' => '3',
        'team' => 'TESTING',
        'status'=>'1',
        'created_at' =>now(),
        'updated_at' =>now()           
        ], [ 
            'id' => '4',
            'team' => 'IOS',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],[ 
            'id' => '5',
            'team' => 'ANDROID',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ],[ 
            'id' => '6',
            'team' => 'MARKETING',
            'status'=>'1',
            'created_at' =>now(),
            'updated_at' =>now()           
        ]
        ]);
    }
}
