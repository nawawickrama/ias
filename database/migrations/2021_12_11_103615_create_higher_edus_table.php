<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHigherEdusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('higher_edus', function (Blueprint $table) {
            $table->id('higher_edu_id');
            $table->string('university');
            $table->string('major_subject');
            $table->string('year');
            $table->string('result_percentage');
            $table->string('higher_edu_type');

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
        Schema::dropIfExists('higher_edus');
    }
}
