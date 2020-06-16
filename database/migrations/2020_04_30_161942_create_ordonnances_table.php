<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdonnancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->id();
            $table->string("numero");
            $table->integer("pvv_id");
            $table->foreign('pvv_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->integer("medecin_id");
            $table->foreign('medecin_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->integer("consultation_id");
            $table->foreign('consultation_id')
                    ->references('id')->on('consultations')
                    ->onDelete('cascade');
            $table->integer("renouvellable")->default(0);
            $table->string("etat")->default('issued');
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
        Schema::dropIfExists('ordonnances');
    }
}
