<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(BLTemplatesTableSeeder::class);
        //$this->call(ERTsTableSeeder::class);
        //$this->call(InstallationsTableSeeder::class);
        //$this->call(ProductsTableSeeder::class);
        //$this->call(SuppliersTableSeeder::class);
        $this->call(OrganisationTypesTableSeeder::class);
        $this->call(OrganisationsTableSeeder::class);
        $this->call(RegionSantesTableSeeder::class);
        $this->call(ZoneSantesTableSeeder::class);
        $this->call(VillesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProduitsTableSeeder::class);
        $this->call(LigneProduitsTableSeeder::class);
        $this->call(ConsultationsTableSeeder::class);
    }
}
