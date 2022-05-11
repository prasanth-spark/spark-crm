<?php

namespace Database\Seeders;

use App\Models\LanguageSkill;
use Illuminate\Database\Seeder;

class LanguageSeed extends Seeder
{
    /**
     * @var array[]
     */
    protected $language = [
        [
            'language' => 'HTML',
        ],
        [
            'language' => 'CSS',
        ],
        [
            'language' => 'JavaScript',
        ],
        [
            'language' => 'PHP',
        ],
        [
            'language' => 'Python',
        ],
        [
            'language' => 'Ruby',
        ],
        [
            'language' => 'Swift',
        ],
        [
            'language' => 'C',
        ],
        [
            'language' => 'C++',
        ],
        [
            'language' => 'C#',
        ],
        [
            'language' => 'Java',
        ],
        [
            'language' => 'Go',
        ],
        [
            'language' => 'Ruby',
        ],
        [
            'language' => 'Rails',
        ],
        [
            'language' => 'React',
        ],
        [
            'language' => 'Vue',
        ],
        [
            'language' => 'Angular',
        ],
        [
            'language' => 'Node',
        ],
        [
            'language' => 'Express',
        ],
        [
            'language' => 'Django',
        ],
        [
            'language' => 'Flask',
        ],
        [
            'language' => 'Laravel',
        ],
        [
            'language' => 'Symfony',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->language as $skill) {
            LanguageSkill::firstOrCreate(
                [
                    'language' => $skill['language'],
                    'status' => '1'
                ]
            );
        }
    }
}
