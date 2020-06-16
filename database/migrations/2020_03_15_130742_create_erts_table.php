<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erts', function (Blueprint $table) {
            $table->id();
            $table->string('alternate_code')->nullable();
            $table->string('identifier')->nullable();
            $table->string('label');
            $table->string('customer_number');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('vat_number')->nullable();
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
        Schema::dropIfExists('erts');
    }
}
