<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShellBLImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shell_b_l_s', function (Blueprint $table) {
            $table->id();
            $table->string('delivery');
            $table->string('shipment');
            $table->string('purchase_order_number');
            $table->string('sale_order');
            $table->string('sold_to_pt');
            $table->string('name_of_sold_to_party');
            $table->string('ship_to');
            $table->string('name_of_the_ship_to_party');
            $table->string('location_of_the_ship_to_party');
            $table->string('material');
            $table->string('description');
            $table->string('total_weight');
            $table->string('wun');
            $table->string('plnt');
            $table->string('plant');
            $table->date('loadg_date');
            $table->date('delivery_date');
            $table->string('bill_doc');
            $table->string('price_ht');
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
        Schema::dropIfExists('shell_b_l_s');
    }
}
