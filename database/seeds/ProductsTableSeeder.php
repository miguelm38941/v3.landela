<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('products')->insert(['product_code' => 'BLY35/50', 'product_label' => '35/50', 'rafael_product_code' => 'BLY35/50', 'rafael_product_label' => 'BITUME ROUT.35/50 BLAYE', 'supplier_code' => 'BLAYE', 'refinery_code' => 'BLAYE', 'refinery_label' => 'BLAYE']);
        DB::table('products')->insert(['product_code' => 'BLY50/70', 'product_label' => '50/70', 'rafael_product_code' => 'BLY50/70', 'rafael_product_label' => 'BITUME ROUT.50/70 BLAYE', 'supplier_code' => 'BLAYE', 'refinery_code' => 'BLAYE', 'refinery_label' => 'BLAYE']);
        DB::table('products')->insert(['product_code' => 'BLY70/100', 'product_label' => '70/100', 'rafael_product_code' => 'BLY70/10', 'rafael_product_label' => 'BITUME ROUT.70/100 BLAYE', 'supplier_code' => 'BLAYE', 'refinery_code' => 'BLAYE', 'refinery_label' => 'BLAYE']);
        DB::table('products')->insert(['product_code' => '152289', 'product_label' => 'PAVING BITUMEN 160/220 EM', 'rafael_product_code' => 'PJ160/22', 'rafael_product_label' => 'BITUME ROUT.160/220E', 'supplier_code' => 'ESSO', 'refinery_code' => '104', 'refinery_label' => 'PJG']);
        DB::table('products')->insert(['product_code' => 'B35/50', 'product_label' => 'B35/50 MENDE-ALPEM-ROUGET', 'rafael_product_code' => 'LAV35/50', 'rafael_product_label' => 'BITUME ROUT.35/50 LA', 'supplier_code' => 'PETROINEOS', 'refinery_code' => 'LAV', 'refinery_label' => 'LAVERA']);
        DB::table('products')->insert(['product_code' => 'B50/70', 'product_label' => 'B50/70 MENDE-ALPEM-ROUGET', 'rafael_product_code' => 'LAV50/70', 'rafael_product_label' => 'BITUME ROUT.50/70 LA', 'supplier_code' => 'PETROINEOS', 'refinery_code' => 'LAV', 'refinery_label' => 'LAVERA']);
        DB::table('products')->insert(['product_code' => 'B70/100', 'product_label' => 'B70/100 MENDE-ALPEM-ROUGET', 'rafael_product_code' => 'LAV70/10', 'rafael_product_label' => 'BITUME ROUT.70/100 L', 'supplier_code' => 'PETROINEOS', 'refinery_code' => 'LAV', 'refinery_label' => 'LAVERA']);
        DB::table('products')->insert(['product_code' => 'B160/220', 'product_label' => 'B160/220 MENDE-ALPEM-ROUGET', 'rafael_product_code' => 'LAV160/2', 'rafael_product_label' => 'BITUME ROUT.160/220', 'supplier_code' => 'PETROINEOS', 'refinery_code' => 'LAV', 'refinery_label' => 'LAVERA']);
    }
}
