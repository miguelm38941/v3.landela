<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('birthdate');
            $table->string('sexe');
            $table->string('etat_civil');
            $table->string('username');
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->integer('ville_id');
            $table->foreign('ville_id')
                    ->references('id')->on('villes');
            $table->integer('organisation_id');
            $table->foreign('organisation_id')
                    ->references('id')->on('organisations');
            $table->integer('zone_sante_id');
            $table->foreign('zone_sante_id')
                    ->references('id')->on('zone_santes');
            $table->integer('region_sante_id');
            $table->foreign('region_sante_id')
                    ->references('id')->on('region_santes');
            $table->string('verified_at')->nullable();
            $table->boolean('active')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
