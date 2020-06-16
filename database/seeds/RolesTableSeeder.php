<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(['slug'=>'ROLE_ADMIN', 'name'=>'Administrateur', 'description'=>'Administrateur']);
        Role::create(['slug'=>'ROLE_PVV', 'name'=>'Pvv', 'description'=>'Personne vivant avec le VIH']);
        Role::create(['slug'=>'ROLE_AGENT', 'name'=>'Agent', 'description'=>'Personne vivant avec le VIH']);
        Role::create(['slug'=>'ROLE_INFIRMIER', 'name'=>'Infirmier', 'description'=>'Personne vivant avec le VIH']);
        Role::create(['slug'=>'ROLE_LABORANTIN', 'name'=>'Laborantin', 'description'=>'Personne vivant avec le VIH']);
        Role::create(['slug'=>'ROLE_MEDECIN', 'name'=>'Médecin', 'description'=>'Personne vivant avec le VIH']);
        Role::create(['slug'=>'ROLE_PREPOSE', 'name'=>'Prepose', 'description'=>'Personne vivant avec le VIH']);
        Role::create(['slug'=>'ROLE_EDUCATEUR', 'name'=>'Relais communautaire', 'description'=>'Personne vivant avec le VIH']);
        Role::create(['slug'=>'ROLE_REGSANTE', 'name'=>'Zone sanitaire', 'description'=>'Personne vivant avec le VIH']);
        Role::create(['slug'=>'ROLE_ZONSANTE', 'name'=>'Région de santé', 'description'=>'Personne vivant avec le VIH']);
    }
}
