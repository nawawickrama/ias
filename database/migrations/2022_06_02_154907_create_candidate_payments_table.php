<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_payments', function (Blueprint $table) {
            $table->id('candidate_payment_id');
            $table->string('reference_no');
            $table->string('payment_category');

            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates');

            $table->unsignedBigInteger('candidate_form_id');
            $table->foreign('candidate_form_id')->references('candidate_form_id')->on('candidate_forms');

            $table->float('full_price');
            $table->date('dead_line');

            $table->enum('status', ['Not-Paid', 'Partially-Paid', 'Pending', 'Rejected', 'Completed'])->default('Not-Paid');

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
        Schema::dropIfExists('candidate_payments');
    }
}
