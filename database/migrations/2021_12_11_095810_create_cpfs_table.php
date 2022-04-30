<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpfs', function (Blueprint $table) {
            $table->id('cpf_id');

            $table->integer('year')->nullable();
            // $table->string('program');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses');

            $table->string('job_feild')->nullable(); //if program is direct job

            $table->boolean('ge_lang'); //1->yes , 0-> no
            $table->string('ge_lang_level')->nullable();
            $table->string('how_to_know')->nullable();

            $table->unsignedBigInteger('agent_id')->nullable();
            $table->text('comment')->nullable();

            $table->text('comment_institute')->nullable();

            $table->integer('application_status')->default(2); //2-> pending 1->approve 0->reject 3->select with condition 5--> out of cpf sttage

            $table->date('status_date')->nullable();

            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates');

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
        Schema::dropIfExists('cpfs');
    }
}
