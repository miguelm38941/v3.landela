<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StandardBLImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_b_l_s', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_note')->nullable();
            $table->string('purchase_order')->nullable();
            $table->string('supplier_code')->nullable();
            $table->string('supplier_label')->nullable();
            $table->string('refinery_code')->nullable();
            $table->string('refinery_label')->nullable();
            $table->string('installation_code')->nullable();
            $table->string('installation_label')->nullable();
            $table->string('customer_code')->nullable();
            $table->string('customer_label')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_label')->nullable();
            $table->date('loadin_date')->nullable();
            $table->string('transporter_code')->nullable();
            $table->string('transporter_label')->nullable();
            $table->boolean('transport_include')->nullable();
            $table->string('quantity')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('transport_rate')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('code_customer_to_invoce')->nullable();
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
        Schema::dropIfExists('standard_b_l_s');
    }
}
