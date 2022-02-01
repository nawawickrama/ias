<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondaryEdusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_edus', function (Blueprint $table) {
            $table->id('secondary_edu_id');

            $table->string('years_level');
            $table->string('duration');
            $table->integer('result_percentage');
            $table->string('sec_edu_type');

            $table->unsignedBigInteger('cpf_id');
            $table->foreign('cpf_id')->references('cpf_id')->on('cpfs');
            
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
        Schema::dropIfExists('secondary_edus');
    }
}
