<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_forms', function (Blueprint $table) {
            $table->id('sub_form_id');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses');

            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('form_id')->on('forms');

            $table->float('price');

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
        Schema::dropIfExists('sub_forms');
    }
}
