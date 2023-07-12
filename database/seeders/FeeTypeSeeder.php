<?php

namespace Database\Seeders;

use App\Models\FeeType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeeTypeSeeder extends Seeder
{

    public function run()
    {
        DB::table('fee_types')->delete();

        $types = ["Tuition Fees","Bus Fees" ];

      

        foreach ($types as $type) {

            feeType::create(["type" => $type]);
        }
    }
}
