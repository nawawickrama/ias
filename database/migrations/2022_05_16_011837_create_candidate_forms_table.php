<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCandidateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_forms', function (Blueprint $table) {
            $table->id('candidate_form_id');
            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates');

            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('form_id')->on('forms');

            $table->unsignedBigInteger('sub_form_id')->nullable(); //if subform available

            $table->string('file_path')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->text('reject_reason')->nullable();
            $table->timestamp('submit_date')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('candidate_forms');
    }
}
