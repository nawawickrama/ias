<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id('candidate_id');
            $table->string('first_name');
            $table->string('sur_name');
            $table->string('program');
            $table->boolean('sex'); //1->male,  0->female
            $table->date('dob');
            $table->string('nationality');
            $table->string('telephone')->unique();
            $table->string('email')->unique();
            $table->string('address');
            $table->boolean('ge_lang'); //1->yes , 0-> no
            $table->string('ge_lang_level');
            $table->string('how_to_know')->nullable();
            $table->string('agent_name')->nullable();

            $table->integer('application_status')->default(2); //2-> pending 1->approve 0->reject
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
        Schema::dropIfExists('candidates');
    }
}
