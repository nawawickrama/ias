<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id('lead_id');

            $table->string('lead_random_number')->nullable();

            $table->string('lead_first_name');
            $table->string('lead_sur_name');
            $table->string('lead_email');

            $table->unsignedBigInteger('lead_course_id');
            $table->foreign('lead_course_id')->references('course_id')->on('courses');

            $table->string('lead_intake_year');
            $table->string('lead_city');

            $table->string('lead_whatsapp')->nullable();
            $table->string('lead_contact')->nullable();

            $table->unsignedBigInteger('lead_country_id');
            $table->foreign('lead_country_id')->references('id')->on('countries');

            $table->string('lead_source');
            $table->text('lead_comment')->nullable();
            $table->integer('status')->default(2); //2-> pending,     0->reject,     1->potential,   3->assigned lead,   4->deleted

            $table->unsignedBigInteger('handle_by')->nullable(); //user_id

            $table->unsignedBigInteger('assign_by')->nullable(); //user id
            $table->dateTime('assign_at')->nullable();

            $table->string('delete_reason')->nullable();

            $table->unsignedBigInteger('deleted_by')->nullable(); //user id
            $table->dateTime('deleted_at')->nullable();

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
        Schema::dropIfExists('leads');
    }
}
