<?php

use Illuminate\Database\Seeder;

class OrganisationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisation_types')->truncate();
        DB::table('organisation_types')->insert(['nom' => 'Pharmacie']);
        DB::table('organisation_types')->insert(['nom' => 'Formation sanitaire']);
        DB::table('organisation_types')->insert(['nom' => 'Zone de santé']);
        DB::table('organisation_types')->insert(['nom' => 'Région sanitaire']);
    }
}
