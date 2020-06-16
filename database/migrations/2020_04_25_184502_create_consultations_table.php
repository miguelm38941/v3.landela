<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->integer('pvv_id');
            $table->foreign('pvv_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->integer('agent_id');
            $table->foreign('agent_id')
                    ->references('id')->on('users');
            $table->integer('medecin_id')->nullable();
            $table->foreign('medecin_id')
                    ->references('id')->on('users');
            $table->integer('infirmier_id')->nullable();
            $table->foreign('infirmier_id')
                    ->references('id')->on('users');
            $table->integer('closed')->default(0);
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
        Schema::dropIfExists('consultations');
    }
}
