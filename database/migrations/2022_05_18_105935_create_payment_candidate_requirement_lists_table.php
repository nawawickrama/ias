<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentCandidateRequirementListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_candidate_requirement_lists', function (Blueprint $table) {
            $table->id('pcrl_id');

            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('form_id')->on('forms');

            $table->unsignedBigInteger('crl_id')->unique();
            $table->foreign('crl_id')->references('candidate_requirement_list_id')->on('candidate_requirement_lists');

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
        Schema::dropIfExists('payment_candidate_requirement_lists');
    }
}
