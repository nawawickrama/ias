<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_guardians', function (Blueprint $table) {
            $table->id('student_guardian_id');
            $table->enum('guardian_title', ['Mr', 'Ms', 'Mrs', 'Dr', 'Prof']);
            $table->string('guardian_firstName');
            $table->string('guardian_lastName');
            $table->string('guardian_email');
            $table->string('guardian_phoneNo');
            $table->string('guardian_mobileNo');
            $table->string('relationship');
            $table->float('income');
            $table->text('qualification');
            $table->string('occupation');
            $table->text('homeAddress');
            $table->text('officeAddress');

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
        Schema::dropIfExists('student_guardians');
    }
}
