<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_addresses', function (Blueprint $table) {
            $table->id('student_address_id');
            $table->text('currentAddress');
            $table->unsignedBigInteger('currentCountry');
            $table->string('currentState');
            $table->string('currentCity');
            $table->string('CurrentPincode');

            $table->text('permanentAddress');
            $table->unsignedBigInteger('permanentCountry');
            $table->string('permanentState');
            $table->string('permanentCity');
            $table->string('permanentPincode');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students');

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
        Schema::dropIfExists('student_addresses');
    }
}
