<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_courses', function (Blueprint $table) {
            $table->id('document_course_id');
            $table->unsignedBigInteger('doc_id');
            $table->foreign('doc_id')->references('document_id')->on('documents');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->boolean('document_course_status')->default(1);
            $table->enum('option', ['Optional', 'Mandatory'])->default('Mandatory');
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
        Schema::dropIfExists('docuemt_courses');
    }
}
