<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateRequirementListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_requirement_lists', function (Blueprint $table) {
            $table->id('candidate_requirement_list_id');

            $table->unsignedBigInteger('requirement_list_id');
            $table->foreign('requirement_list_id')->references('requirement_list_id')->on('requirement_lists');

            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates');
            $table->enum('isComplete', ['Yes', 'No'])->default('No');

            $table->string('reference_no')->nullable();
            $table->date('dead_line')->nullable();

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
        Schema::dropIfExists('student_requirement_lists');
    }
}
