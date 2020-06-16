<?php

use Illuminate\Database\Seeder;

class ZoneSantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zone_santes')->truncate();
        DB::table('zone_santes')->insert(['nom' => 'Zone Kinshasa']);
    }
}
