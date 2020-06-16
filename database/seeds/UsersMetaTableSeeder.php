<?php

use Illuminate\Database\Seeder;
use UsersMeta;

class UsersMetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_metas')->truncate();
        UsersMeta::create(['user_id' => 'Pvv1', 'codepvv' => 'CDVS2541', 
            'adresse' => '1998-10-12','debut_depistage' => '1998-10-12', 
            'debut_traitement' => '1998-10-12'
        ]);
    }
}
