<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');

            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates');

            $table->unsignedBigInteger('candidate_payment_id');
            $table->foreign('candidate_payment_id')->references('candidate_payment_id')->on('candidate_payments');

            $table->string('reference_no');

            $table->float('full_amount');

            $table->float('paid_amount');
            $table->float('remaining_amount');

            $table->date('paid_date');

            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');

            $table->string('reject_reason')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
