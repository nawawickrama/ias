<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id('activity_log_id');
            $table->string('model'); //App\Models\User......
            $table->unsignedBigInteger('property_id'); //leadId or some
            $table->text('info');
            $table->string('event');
            $table->unsignedBigInteger('user_id'); //user
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
        Schema::dropIfExists('activity_logs');
    }
}
