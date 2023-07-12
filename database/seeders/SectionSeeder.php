<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $sections = [
            [
                'name' => ['en' => 'section one', 'ar' => 'اول'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 1,
            ],
            [
                'name' => ['en' => 'section two', 'ar' => 'ثانى'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 1,
            ],
            [
                'name' => ['en' => 'section three', 'ar' => 'ثالث'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 1,
            ],

            [
                'name' => ['en' => 'section one', 'ar' => 'اول'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 2,
            ],
            [
                'name' => ['en' => 'section two', 'ar' => 'ثانى'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 2,
            ],
            [
                'name' => ['en' => 'section three', 'ar' => 'ثالث'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 2,
            ],

            [
                'name' => ['en' => 'section one', 'ar' => 'اول'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 3,
            ],
            [
                'name' => ['en' => 'section two', 'ar' => 'ثانى'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 3,
            ],
            [
                'name' => ['en' => 'section three', 'ar' => 'ثالث'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 3,
            ],
            [
                'name' => ['en' => 'section one', 'ar' => 'اول'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 4,
            ],
            [
                'name' => ['en' => 'section two', 'ar' => 'ثانى'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 4,
            ],
            [
                'name' => ['en' => 'section three', 'ar' => 'ثالث'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 4,
            ],

            [
                'name' => ['en' => 'section one', 'ar' => 'اول'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 5,
            ],
            [
                'name' => ['en' => 'section two', 'ar' => 'ثانى'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 5,
            ],
            [
                'name' => ['en' => 'section three', 'ar' => 'ثالث'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 5,
            ],

            [
                'name' => ['en' => 'section one', 'ar' => 'اول'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 6,
            ],
            [
                'name' => ['en' => 'section two', 'ar' => 'ثانى'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 6,
            ],
            [
                'name' => ['en' => 'section three', 'ar' => 'ثالث'],
                'status'=>"available",
                'grade_id' => 1,
                'class_id' => 6,
            ],

            [
                'name' => ['en' => 'section one', 'ar' => 'اول'],
                'status'=>"available",
                'grade_id' => 2,
                'class_id' => 7,
            ],
            [
                'name' => ['en' => 'section two', 'ar' => 'ثانى'],
                'status'=>"available",
                'grade_id' => 2,
                'class_id' => 8,
            ],
            [
                'name' => ['en' => 'section three', 'ar' => 'ثالث'],
                'status'=>"available",
                'grade_id' => 2,
                'class_id' => 9,
            ],

            [
                'name' => ['en' => 'section one', 'ar' => 'اول'],
                'status'=>"available",
                'grade_id' => 3,
                'class_id' => 10,
            ],
            [
                'name' => ['en' => 'section two', 'ar' => 'ثانى'],
                'status'=>"available",
                'grade_id' => 3,
                'class_id' => 11,
            ]
           

        ];

       
        foreach($sections as $section){
            Section::create([
                'name' => $section['name'],
                'status' => $section['status'],
                'grade_id' => $section['grade_id'],
                'class_id' => $section['class_id'],
                ]); 
           
        }
    }
}
