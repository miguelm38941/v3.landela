<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BLTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('b_l_templates')->truncate();
        DB::table('b_l_templates')->insert(['name' => 'Standard']);
        DB::table('b_l_templates')->insert(['name' => 'Blaye']);
        DB::table('b_l_templates')->insert(['name' => 'Petroineos']);
        DB::table('b_l_templates')->insert(['name' => 'Vitol']);
    }
}

