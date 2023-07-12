<?php

namespace Database\Seeders;

use App\Models\Fee;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\MyParent;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\ClassSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\GenderSeeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\FeeTypeSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\ReligionSeeder;
use Database\Seeders\TypeBloodSeeder;
use Database\Factories\StudentFactory;
use Database\Factories\TeacherFactory;
use Database\Factories\MyParentFactory;
use Database\Seeders\NationalitieSeeder;
use Database\Seeders\SpecializationSeeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        DB::table('my_parents')->delete();
        DB::table('students')->delete();
        DB::table('teachers')->delete();
        DB::table('fees')->delete();
       

        $this->call(AdminSeeder::class);
        $this->call(TypeBloodSeeder::class);
        $this->call(NationalitieSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(FeeTypeSeeder::class);
        $this->call(SettingSeeder::class);

        MyParent::factory(20)->create();
        Student::factory(10)->create();   
        Teacher::factory(10)->create();  
        Fee::factory(2)->create();    

        $this->call(SubjectSeeder::class);

    }
}
