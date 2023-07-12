<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();

        $classrooms = [
            [
                'class_name' => ['en' => 'class one', 'ar' => ' الصف الاول'],
                'grade_id' => 1
            ],
            [
                'class_name' => ['en' => 'class two', 'ar' => ' الصف الثاني'],
                'grade_id' => 1
            ],
            [
                'class_name' => ['en' => 'class three', 'ar' => ' الصف الثالث'],
                'grade_id' =>1
            ],
            [
                'class_name' => ['en' => 'class four', 'ar' => ' الصف الرابع'],
                'grade_id' => 1
            ],
            [
                'class_name' => ['en' => 'class five', 'ar' => ' الصف الخامس'],
                'grade_id' => 1
            ],
            [
                'class_name' => ['en' => 'class six', 'ar' => ' الصف السادس'],
                'grade_id' => 1
            ],
            [
                'class_name' => ['en' => 'class one', 'ar' => ' الصف الاول'],
                'grade_id' => 2
            ],

            [
                'class_name' => ['en' => 'class two', 'ar' => ' الصف الثاني'],
                'grade_id' => 2
            ],
            [
                'class_name' => ['en' => 'class three', 'ar' => ' الصف الثالث'],
                'grade_id' => 2
            ],
            [
                'class_name' => ['en' => 'class one', 'ar' => ' الصف الاول'],
                'grade_id' => 3
            ],
            [
                'class_name' => ['en' => 'class two', 'ar' => ' الصف الثاني'],
                'grade_id' => 3
            ],
            [
                'class_name' => ['en' => 'class three', 'ar' => ' الصف الثالث'],
                'grade_id' => 3
            ],

        ];

               
        foreach($classrooms as $classroom){
            Classroom::create([
                'class_name' => $classroom['class_name'],
                'grade_id' => $classroom['grade_id'],
    
                ]); 
           
        }
    }
}
