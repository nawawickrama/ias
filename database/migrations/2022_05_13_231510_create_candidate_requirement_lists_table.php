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

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('isComplete', ['Yes', 'No'])->default('No');
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
