<?php

use Illuminate\Database\Seeder;

class VillesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('villes')->truncate();
        DB::table('villes')->insert(['nom' => 'Kinshasa']);
        DB::table('villes')->insert(['nom' => 'Bomoi']);
        DB::table('villes')->insert(['nom' => 'Kinsangani']);
    }
}
