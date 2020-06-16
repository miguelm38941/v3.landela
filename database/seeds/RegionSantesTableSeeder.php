<?php

use Illuminate\Database\Seeder;

class RegionSantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('region_santes')->truncate();
        DB::table('region_santes')->insert(['nom' => 'Région Kinshasa']);
    }
}
