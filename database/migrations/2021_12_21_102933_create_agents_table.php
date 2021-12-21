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
            $table->string('agent_name');
            $table->string('agent_email')->unique();
            $table->string('agent_tp')->unique();
            $table->string('agent_country');
            $table->string('agent_contact_person_name');
            $table->string('agent_whtaspp')->unique();
            $table->string('agent_web_site')->unique();
            $table->boolean('agent_status')->default('0');
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
