<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamensPrescritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examens_prescrits', function (Blueprint $table) {
            $table->id();
            $table->integer('consultation_id');
            $table->integer('medecin_id');
            $table->integer('pvv_id');
            $table->string('examen_slug');
            $table->text('resultats');
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
        Schema::dropIfExists('examens_prescrits');
    }
}
