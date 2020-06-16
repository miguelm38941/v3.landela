<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BlayeBLImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blaye_b_l_s', function (Blueprint $table) {
            $table->id();
            $table->string('bl_day');
            $table->string('command_number');
            $table->string('accounting_site_code');
            $table->string('bl_product_code');
            $table->string('bl_site_code');
            $table->string('customer_delivery_label');
            $table->string('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blaye_b_l_s');
    }
}
