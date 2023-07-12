<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
   
    public function run()
    {
        DB::table('settings')->delete();

        $data=[
            ['key' => 'current_session', 'value' => '2023-2024'],
            ['key' => 'school_title', 'value' => 'AS'],
            ['key' => 'school_name', 'value' => 'Ashrakt International Schools'],
            ['key' => 'end_first_term', 'value' => '01-4-2023'],
            ['key' => 'end_second_term', 'value' => '01-08-2023'],
            ['key' => 'phone', 'value' => '01095425446'],
            ['key' => 'address', 'value' => 'Egypt'],
            ['key' => 'school_email', 'value' => 'ashraktamin678@gmail.com'],
            ['key' => 'logo', 'value' => 'logo1.jpg'],
        ];

        DB::table('settings')->insert($data);
        
    }
}
