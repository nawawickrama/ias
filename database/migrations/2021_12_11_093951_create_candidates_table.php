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
            $table->boolean('sex'); //1->male,  0->female
            $table->date('dob');
            $table->string('telephone')->unique();
            $table->string('email')->unique();

            $table->string('address');
            $table->string('nationality');

            // relation with countries table
            $table->unsignedBigInteger('country');

            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->string('passport_no')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->enum('isComplete', ['Yes','No'])->default('No');

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
