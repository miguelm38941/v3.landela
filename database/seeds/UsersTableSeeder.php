<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\User;
use \App\Role;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        
        $now = \Carbon\Carbon::now();
        $adminRole = Role::where('slug', 'ROLE_ADMIN')->first();
        $pvvRole = Role::where('slug', 'ROLE_PVV')->first();
        $agentRole = Role::where('slug', 'ROLE_AGENT')->first();
        $medecinRole = Role::where('slug', 'ROLE_MEDECIN')->first();
        $infirmierRole = Role::where('slug', 'ROLE_INFIRMIER')->first();
        $relaisRole = Role::where('slug', 'ROLE_EDUCATEUR')->first();
        $preposeRole = Role::where('slug', 'ROLE_PREPOSE')->first();
        $admin = User::create([
            'first_name' => 'Admin', 
            'last_name' => 'User', 
            'birthdate' => '1998-10-12',
            'sexe' => 'User', 
            'etat_civil' => 'User', 
            'username' => 'admin', 
            'password' => 'lmsc1234', 
            'email' => 'admin@gmail.com', 
            'telephone' => '123456', 
            'ville_id' => 1, 
            'organisation_id' => 1,
            'zone_sante_id' => 1,
            'region_sante_id' => 1,
            'active' => true,
        ]);
        $admin->roles()->attach($adminRole);

        $admin = User::create(['first_name' => 'Pvv1', 'last_name' => 'User', 
            'birthdate' => '1998-10-12','sexe' => 'Masculin', 
            'etat_civil' => 'Marié', 'username' => 'pvv1', 
            'password' => 'lmsc1234', 'email' => 'pvv1@gmail.com', 
            'telephone' => '123456', 'ville_id' => 1, 'organisation_id' => 1,'zone_sante_id' => 1,
            'region_sante_id' => 1,'active' => true,
        ]);
        $admin->roles()->attach($pvvRole);
        $admin = User::create(['first_name' => 'Agent1', 'last_name' => 'User', 
            'birthdate' => '1998-10-12','sexe' => 'Masculin', 
            'etat_civil' => 'Marié', 'username' => 'agent1', 
            'password' => 'lmsc1234', 'email' => 'agent1@gmail.com', 
            'telephone' => '123456', 'ville_id' => 1, 'organisation_id' => 1,'zone_sante_id' => 1,
            'region_sante_id' => 1,'active' => true,
        ]);
        $admin->roles()->attach($agentRole);
        $admin = User::create(['first_name' => 'Infirmier1', 'last_name' => 'User', 
            'birthdate' => '1998-10-12','sexe' => 'Masculin', 
            'etat_civil' => 'Marié', 'username' => 'infirmier1', 
            'password' => 'lmsc1234', 'email' => 'infirmier1@gmail.com', 
            'telephone' => '123456', 'ville_id' => 1, 'organisation_id' => 1,'zone_sante_id' => 1,
            'region_sante_id' => 1,'active' => true,
        ]);
        $admin->roles()->attach($infirmierRole);
        $admin = User::create(['first_name' => 'Medecin1', 'last_name' => 'User', 
            'birthdate' => '1998-10-12','sexe' => 'Masculin', 
            'etat_civil' => 'Marié', 'username' => 'medecin1', 
            'password' => 'lmsc1234', 'email' => 'medecin1@gmail.com', 
            'telephone' => '123456', 'ville_id' => 1, 'organisation_id' => 1,'zone_sante_id' => 1,
            'region_sante_id' => 1,'active' => true,
        ]);
        $admin->roles()->attach($medecinRole);

        /*DB::table('users')->insert([
                'first_name' => 'Admin', 
                'last_name' => 'User', 
                'username' => 'admin', 
                'email' => 'admin@gmail.com', 
                'password' => Hash::make('Colas1234'), 
                'computername' => 'ADMIN-PC', 
                'volume_label' => 'H524-TH42', 
                'active' => true, 
                'created_at' => $now->toDateTimeString(), 
                'updated_at' => $now->toDateTimeString()
            ]);*/
    }
}
