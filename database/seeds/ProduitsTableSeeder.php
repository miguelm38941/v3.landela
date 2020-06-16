<?php

use Illuminate\Database\Seeder;
use \App\Produit;

class ProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produits')->truncate();
        
        Produit::create([
            'code' => 'P0001', 
            'nom' => 'Azythromicine', 
            'forme' => 'Comprimés',
            'unite' => 'Plaquette'
        ]);
        Produit::create([
            'code' => 'P0002', 
            'nom' => 'Hydroxyde Chloroquine', 
            'forme' => 'Sirop',
            'unite' => 'Flacon'
        ]);
        Produit::create([
            'code' => 'P0003', 
            'nom' => 'Avipirine', 
            'forme' => 'Comprimés',
            'unite' => 'Boîte'
        ]);
        Produit::create([
            'code' => 'P0004', 
            'nom' => 'D-Artep', 
            'forme' => 'Comprimés',
            'unite' => 'Boîte'
        ]);
    }
}
