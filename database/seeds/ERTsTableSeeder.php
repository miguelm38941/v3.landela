<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ERTsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('erts')->truncate();
        DB::table('erts')->insert(['customer_number' => '1648696', 'label' => 'Colas Midi-Méditerranée', 'address1' => 'A l\'attention de René LAQUET', 'address2' => '855, Rue Réné Descartes', 'zip_code' => '13792', 'city' => 'AIX EN PROVENCE CEDEX 3', 'country' => '', 'payment_mode' => 'Extourne en compte 45100 C06001', 'vat_number' => 'FR 55 329 368 526']);
        DB::table('erts')->insert(['customer_number' => '1648698', 'label' => 'Colas Sud-Oeust COL3300', 'address1' => 'A l\'attention de Benoît BOUNNOUVRIER', 'address2' => '6, Avenue Charles Lindbergh', 'zip_code' => '33694', 'city' => 'MERIGNAC CEDEX', 'country' => '', 'payment_mode' => 'Extourne en compte 45100 C07001', 'vat_number' => 'FR 15 405 368 211']);
        DB::table('erts')->insert(['customer_number' => '1648706', 'label' => 'COLAS Centre-Ouest COL4405', 'address1' => 'A l\'attention de Isabelle CLAUDE', 'address2' => 'Zac de la Chantrerie - 2, rue Gaspard Coriolis', 'zip_code' => '44307', 'city' => 'NANTES CEDEX 3', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C01001', 'vat_number' => 'FR 75 329 338 883']);
        DB::table('erts')->insert(['customer_number' => '1648713', 'label' => 'AXTER', 'address1' => 'A l\'attention de Pascal LAUT', 'address2' => '1, rue Joseph Coste', 'zip_code' => '59552', 'city' => 'COURCHELETTES', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C24690', 'vat_number' => 'FR 60 351 844 527']);
        DB::table('erts')->insert(['customer_number' => '1648714', 'label' => 'COLAS Ile-de-France Normandie COL7800', 'address1' => 'A l\'attention de JJacques TROISSANT', 'address2' => '2, rue Jean Mermoz - BP 31', 'zip_code' => '78114', 'city' => 'MAGNY LES HAMEAUX', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C02001', 'vat_number' => 'FR 57 329 168 157']);
        DB::table('erts')->insert(['customer_number' => '1648716', 'label' => 'COLAS Nord-Est COL5426', 'address1' => 'A l\'attention de Isabelle KALANQUIN', 'address2' => '44, bd de la Mothe - BP 50519', 'zip_code' => '54008', 'city' => 'NANCY CEDEX', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C04001', 'vat_number' => 'FR 96 329 198 337']);
        DB::table('erts')->insert(['customer_number' => '1648718', 'label' => 'COLAS Rhône-Alpes-Auvergne COL6974', 'address1' => 'A l\'attention de Bruno BISCU-Immeuble Echangeur', 'address2' => '2, avenue Tony Garnier', 'zip_code' => '69363', 'city' => 'LYON CEDEX 07', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C05001', 'vat_number' => 'FR 14 329 393 797']);
        DB::table('erts')->insert(['customer_number' => '1648722', 'label' => 'AXIMA Centre COL6950', 'address1' => 'A la rue Gabriel Voisin', 'address2' => 'BP39', 'zip_code' => '69652', 'city' => 'VILLEFRANCHE SUR SAONE', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C15056', 'vat_number' => 'FR 72 573 780 822']);
        DB::table('erts')->insert(['customer_number' => '1648723', 'label' => 'SNAF ROUTES', 'address1' => 'A l\'attention de Etabli. SCSNAF', 'address2' => 'BP39', 'zip_code' => '59092', 'city' => 'LILLE CEDEX 9', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C15088', 'vat_number' => 'FR 27 955 803 085']);
        DB::table('erts')->insert(['customer_number' => '1721454', 'label' => 'BP France', 'address1' => 'A l\'attention de Immeuble Le Cervier', 'address2' => '12, avenue des Béguines', 'zip_code' => '95866', 'city' => 'CERGY PONTOISE CEDEX', 'country' => '', 'payment_mode' => 'Virement à 30 J', 'vat_number' => 'FR 37 542 034 327']);
        DB::table('erts')->insert(['customer_number' => '1736211', 'label' => 'COLAS SUISSE', 'address1' => '126, Rue Dos Chez Merat', 'address2' => '', 'zip_code' => '2854', 'city' => 'BASSECOURT', 'country' => 'SUISSE', 'payment_mode' => 'Comptant à réception', 'vat_number' => '']);
        DB::table('erts')->insert(['customer_number' => '1796762', 'label' => 'AXIMUM PRODUITS DE MARQUAGE', 'address1' => '5 Rue du Quai du Débarquement', 'address2' => '', 'zip_code' => '76100', 'city' => 'ROUEN', 'country' => '', 'payment_mode' => 'Extourne en compte courant', 'vat_number' => 'FR 91 700 501 208']);
        DB::table('erts')->insert(['customer_number' => '1844276', 'label' => 'COLAS Belgium SA', 'address1' => '', 'address2' => 'Rue Nestor Martin', 'zip_code' => '1082', 'city' => 'BRUXELLES', 'country' => 'BELGIQUE', 'payment_mode' => 'Extourne en compte courant', 'vat_number' => 'BE 0434 888 612']);
        DB::table('erts')->insert(['customer_number' => '2024342', 'label' => 'TRAVAUX ET PRODUITS ROUTIERS', 'address1' => 'Rue du Coucou', 'address2' => 'BP 29', 'zip_code' => 'B7640', 'city' => 'ANTOING', 'country' => 'BELGIQUE', 'payment_mode' => 'Extourne en compte courant', 'vat_number' => 'BE 0422 349 579']);
        DB::table('erts')->insert(['customer_number' => '2077609', 'label' => 'TCTPP', 'address1' => 'Rue de la Carrière', 'address2' => 'Le Bourg', 'zip_code' => '63500', 'city' => 'PARDINES', 'country' => '', 'payment_mode' => 'Extourne en compte courant', 'vat_number' => 'FR 12 332 049 527']);
        DB::table('erts')->insert(['customer_number' => '2198122', 'label' => 'PERRIER TP COL6921', 'address1' => '13 Route de Lyon - A l\'attention de Thierry PERNET', 'address2' => 'BP 164', 'zip_code' => '69802', 'city' => 'SAINT PRIEST CEDEX', 'country' => '', 'payment_mode' => 'Extourne en compte courant', 'vat_number' => 'FR 93 778 147 801']);
        DB::table('erts')->insert(['customer_number' => '2211909', 'label' => 'GIE A63', 'address1' => '812, rue Estrade du Barbail', 'address2' => '', 'zip_code' => '40210', 'city' => 'LABOUHEYRE', 'country' => '', 'payment_mode' => 'Virement à 30 J', 'vat_number' => 'FR 83 589 182 61']);
        DB::table('erts')->insert(['customer_number' => '2299463', 'label' => 'COLAS GRANDS TRAVAUX', 'address1' => '3 avenue des Erables', 'address2' => '', 'zip_code' => '54180', 'city' => 'HEILLECOURT', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C10003', 'vat_number' => 'FR 30 410 529 226']);
        DB::table('erts')->insert(['customer_number' => '2703475', 'label' => 'GIE CONSTRUCTEURS CSO VICHY', 'address1' => 'Immeuble Echangeur', 'address2' => '2 avenue Tony Garnier', 'zip_code' => '69007', 'city' => 'LYON', 'country' => '', 'payment_mode' => 'Virement à 30 J', 'vat_number' => 'FR 33 535 053 656']);
        DB::table('erts')->insert(['customer_number' => '2704135', 'label' => ' OC\'VIA CONSTRUCTION', 'address1' => 'Service Comptabilité', 'address2' => '6200 Route de Générac CS 58240', 'zip_code' => '30972', 'city' => 'NIMES CEDEX', 'country' => '', 'payment_mode' => 'Virement à 30 J', 'vat_number' => 'FR 49 752 271 452']);
        DB::table('erts')->insert(['customer_number' => '2715669', 'label' => ' BOUYGUES TP Régions France', 'address1' => '', 'address2' => 'Rue Pierre et Marie Curie', 'zip_code' => '31670', 'city' => 'LABEGE', 'country' => '', 'payment_mode' => 'Virement à 30 J', 'vat_number' => 'FR 42 722 069 366']);
        DB::table('erts')->insert(['customer_number' => '2820131', 'label' => ' SMAC COL3107', 'address1' => '143, Avenue de Verdun', 'address2' => '', 'zip_code' => '92130', 'city' => 'ISSY LES MOULINEAUX', 'country' => '', 'payment_mode' => 'Extourne en compte courant 45100 C24001', 'vat_number' => 'FR 61 682 040 837']);
        DB::table('erts')->insert(['customer_number' => '4005585', 'label' => ' Société CORSOVIA SEP FIGARI', 'address1' => 'A l\'attention de Olivier NOEL', 'address2' => '', 'zip_code' => '59092', 'city' => 'LILLE CEDEX 9', 'country' => '', 'payment_mode' => 'Extourne', 'vat_number' => 'FR 50 843 527 953']);
        DB::table('erts')->insert(['customer_number' => '4021037', 'label' => ' COLAS PROJECTS  COL7515', 'address1' => '', 'address2' => '', 'zip_code' => '59092', 'city' => 'LILLE CEDEX 9', 'country' => '', 'payment_mode' => 'Extourne', 'vat_number' => 'FR 55 849 483 011']);

    }
}
