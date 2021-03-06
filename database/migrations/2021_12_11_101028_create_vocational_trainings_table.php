<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVocationalTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocational_trainings', function (Blueprint $table) {
            $table->id('v_training_id');
            $table->string('field');
            $table->string('complete_year');
            $table->integer('result_percentage');
            $table->string('duration');

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
        Schema::dropIfExists('vocational_trainings');
    }
}
;