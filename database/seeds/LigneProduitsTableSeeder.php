<?php

use Illuminate\Database\Seeder;
use \App\LigneProduit;
use \App\Produit;
use Illuminate\Support\Facades\DB;

class LigneProduitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produits')->truncate();
        
        $produit1 = Produit::find(1);
        $produit2 = Produit::find(2);
        $produit3 = Produit::find(3);
        $produit4 = Produit::find(4);
        $ligneproduit1 = LigneProduit::create([ 
            'nom' => 'Ligne Malaria'
        ]);
        $ligneproduit1->produits()->attach($produit2);
        $ligneproduit1->produits()->attach($produit4);
        $ligneproduit2 = LigneProduit::create([ 
            'nom' => 'Ligne Covid-19'
        ]);
        $ligneproduit2->produits()->attach($produit1);
        $ligneproduit2->produits()->attach($produit2);
        $ligneproduit2->produits()->attach($produit3);
    }
}
