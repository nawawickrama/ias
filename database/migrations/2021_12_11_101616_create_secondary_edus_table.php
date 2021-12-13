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

            $table->string('years/level');
            $table->string('duration');
            $table->integer('result_percentage');
            // $table->integer('sec_edu_type');

            // $table->unsignedBigInteger('candidate_id');
            // $table->foreign('candidate_id')->references('candidate_id')->on('candidates');
            
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
