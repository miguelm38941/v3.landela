<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->truncate();
        DB::table('suppliers')->insert(['name' => 'Blaye', 'address' => 'Adresse de Blaye', 'phone' => '123456']);
        DB::table('suppliers')->insert(['name' => 'Petroineos', 'address' => 'Adresse de Petroineos', 'phone' => '123456']);
        DB::table('suppliers')->insert(['name' => 'Shell', 'address' => 'Adresse de Shell', 'phone' => '123456']);
        DB::table('suppliers')->insert(['name' => 'Total', 'address' => 'Adresse de Total', 'phone' => '123456']);
        DB::table('suppliers')->insert(['name' => 'Vitol', 'address' => 'Adresse de Vitol', 'phone' => '123456']);
    }
}
