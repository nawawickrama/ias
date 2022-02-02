<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id('agent_id');

            $table->string('agent_tp_1')->unique();
            $table->string('agent_tp_2')->nullable();
            $table->unsignedBigInteger('agent_country');

            $table->string('agent_contact_person_name');
            $table->string('agent_whtaspp')->nullable();

            $table->string('agent_web_site')->nullable();

            $table->boolean('agent_status')->default('0');
            
            $table->string('reference_no')->unique();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('agents');
    }
}
