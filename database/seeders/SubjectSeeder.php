<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
   
    public function run()
    {
        DB::table('subjects')->delete();

        $subjects = [
            [
                'name' => 'arabic',
                'grade_id' => 1,
                'classroom_id' => 1,
                'teacher_id' => 1
            ],
            [
                'name' => 'english',
                'grade_id' => 1,
                'classroom_id' => 1,
                'teacher_id' => 2
            ],
            [
                'name' => 'math',
                'grade_id' => 1,
                'classroom_id' => 1,
                'teacher_id' => 3

            ], [
                'name' => 'arabic',
                'grade_id' => 1,
                'classroom_id' => 2,
                'teacher_id' => 1

            ], [
                'name' => 'english',
                'grade_id' => 1,
                'classroom_id' => 2,
                'teacher_id' => 2

            ], [
                'name' => 'math',
                'grade_id' => 1,
                'classroom_id' => 2,
                'teacher_id' => 3

            ], [
                'name' => 'arabic',
                'grade_id' => 2,
                'classroom_id' => 7,
                'teacher_id' => 1

            ], [
                'name' => 'english',
                'grade_id' => 2,
                'classroom_id' => 7,
                'teacher_id' => 2

            ], [
                'name' => 'math',
                'grade_id' => 2,
                'classroom_id' => 7,
                'teacher_id' => 3
            ], [
                'name' => 'arabic',
                'grade_id' => 2,
                'classroom_id' => 8,
                'teacher_id' => 1

            ], [
                'name' => 'english',
                'grade_id' => 2,
                'classroom_id' => 8,
                'teacher_id' => 2
            ], [
                'name' => 'math',
                'grade_id' => 2,
                'classroom_id' => 8,
                'teacher_id' => 3

            ], [
                'name' => 'arabic',
                'grade_id' => 2,
                'classroom_id' => 9,
                'teacher_id' => 1

            ], [
                'name' => 'english',
                'grade_id' => 2,
                'classroom_id' => 9,
                'teacher_id' => 2

            ], [
                'name' => 'math',
                'grade_id' => 2,
                'classroom_id' => 9,
                'teacher_id' => 3

            ]
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject['name'],
                'grade_id' => $subject['grade_id'],
                'classroom_id' => $subject['classroom_id'],
                'teacher_id' => $subject['teacher_id'],
            ]);
        }
    }
}
