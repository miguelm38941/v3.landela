<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VitolBLImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitol_b_l_s', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->string('incoterm');
            $table->string('product');
            $table->string('period');
            $table->string('order_number');
            $table->date('bl_date');
            $table->string('status');
            $table->string('net_quantity');
            $table->string('uom_quantity');
            $table->string('ship_to');
            $table->string('country');
            $table->string('transporter');
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
        Schema::dropIfExists('vitol_b_l_s');
    }
}
