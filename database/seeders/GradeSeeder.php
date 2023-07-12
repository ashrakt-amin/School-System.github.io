<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();

        $grades = [
            [
                'name' => ['en' => 'primary stage', 'ar' => 'المرحله الابتدائية'],
                'notes' => 'This handout will help you understand how paragraphs are formed, how to develop stronger paragraphs, and how to completely and clearly express your ideas.'
            ],
            [
                'name' => ['en' => 'middle stage', 'ar' => 'المرحله الاعداديه'],
                'notes' => 'This handout will help you understand how paragraphs are formed, how to develop stronger paragraphs, and how to completely and clearly express your ideas.'
            ],
            [
                'name' => ['en' => 'secondary stage', 'ar' => 'المرحله الثانويه'],
                'notes' => 'This handout will help you understand how paragraphs are formed, how to develop stronger paragraphs, and how to completely and clearly express your ideas.'
            ]
        ];

       foreach($grades as $grade){
        Grade::create([
            'name' => $grade['name'],
            'notes' => $grade['notes'],

            ]); 
       
    }
     
        
    }
}
