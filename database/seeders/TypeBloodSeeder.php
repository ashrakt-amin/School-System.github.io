<?php

namespace Database\Seeders;

use App\Models\TypeBlood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeBloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_bloods')->delete();
        $types = ['A+' , 'A-' , 'O+' ,'O-' , 'AB+' , 'AB-'];
        foreach($types as $type){
            TypeBlood::create([ "name" => $type ]);

        }
    }
}
