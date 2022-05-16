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
            $table->float('paid_amount');
            $table->dateTime('paid_date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->unsignedBigInteger('form_type');

            $table->unsignedBigInteger('candidate_form_id');
            $table->foreign('candidate_form_id')->references('candidate_form_id')->on('candidate_forms');

            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates');

            $table->float('full_payment');
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);


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
