<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstallationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('installations')->truncate();
        DB::table('installations')->insert(['ue' => 'UE1257', 'ue_mnemo' => 'ABS20414BT', 'ue_lib_installation' => 'MEDAN', 'dossier_zephyr' => '', 'up' => 'UP1', 'up_mnemo' => 'ABS006']);
        DB::table('installations')->insert(['ue' => 'UE1258', 'ue_mnemo' => 'ABS23381BT', 'ue_lib_installation' => 'ACEH', 'dossier_zephyr' => '', 'up' => 'UP2', 'up_mnemo' => 'ABS002']);
        DB::table('installations')->insert(['ue' => 'UE1259', 'ue_mnemo' => 'ABS30115BT', 'ue_lib_installation' => 'PALEMBANG', 'dossier_zephyr' => '', 'up' => 'UP3', 'up_mnemo' => 'ABS007']);
        DB::table('installations')->insert(['ue' => 'UE1260', 'ue_mnemo' => 'ABS42446BT', 'ue_lib_installation' => 'ABS - CIWANDAN', 'dossier_zephyr' => '', 'up' => 'UP4', 'up_mnemo' => 'ABS001']);
        DB::table('installations')->insert(['ue' => 'UE1262', 'ue_mnemo' => 'ABS42447BT', 'ue_lib_installation' => 'SRC - CIWANDAN', 'dossier_zephyr' => '', 'up' => 'UP6', 'up_mnemo' => 'ABS005']);
        DB::table('installations')->insert(['ue' => 'UE1261', 'ue_mnemo' => 'ABS74322BT', 'ue_lib_installation' => 'SAMPIT', 'dossier_zephyr' => '', 'up' => 'UP5', 'up_mnemo' => 'ABS003']);
        DB::table('installations')->insert(['ue' => 'UE1263', 'ue_mnemo' => 'ABS76111BT', 'ue_lib_installation' => 'BALIKPAPAN', 'dossier_zephyr' => '', 'up' => 'UP7', 'up_mnemo' => 'ABS004']);
        DB::table('installations')->insert(['ue' => 'UE1387', 'ue_mnemo' => 'ADC00002BT', 'ue_lib_installation' => 'HAI PHONG', 'dossier_zephyr' => '', 'up' => 'UP1419', 'up_mnemo' => 'ADC008']);
        DB::table('installations')->insert(['ue' => 'UE1388', 'ue_mnemo' => 'ADC00003BT', 'ue_lib_installation' => 'DONG NAI', 'dossier_zephyr' => '', 'up' => 'UP1420', 'up_mnemo' => 'ADC009']);
    }
}
