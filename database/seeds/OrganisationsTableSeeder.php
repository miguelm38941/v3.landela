<?php

use Illuminate\Database\Seeder;

class OrganisationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisations')->truncate();
        DB::table('organisations')->insert(['nom' => 'Pharmacie Hopîtal Kalembelembe','type_id' => 1]);
    }
}
