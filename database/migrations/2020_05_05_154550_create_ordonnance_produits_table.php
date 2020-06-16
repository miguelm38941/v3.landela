<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdonnanceProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordonnance_produits', function (Blueprint $table) {
            $table->id();
            $table->integer('ordonnance_id')
                    ->references('id')->on('ordonnances')
                    ->onDelete('cascade');
            $table->integer('produit_id')
                    ->references('id')->on('produits')
                    ->onDelete('cascade');
            $table->string('quantite');
            $table->string('posologie');
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
        Schema::dropIfExists('ordonnance_produits');
    }
}
