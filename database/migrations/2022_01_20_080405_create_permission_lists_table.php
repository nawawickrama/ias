<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_lists', function (Blueprint $table) {
            $table->id('permission_list_id');

            $table->string('name');
            $table->boolean('view')->default(0);
            $table->boolean('create')->default(0);
            $table->boolean('edit')->default(0);
            $table->boolean('remove')->default(0);
            $table->boolean('accept')->default(0);
            $table->boolean('download')->default(0);
            $table->boolean('rollback')->default(0);
            $table->boolean('active_deactive')->default(0);
            $table->boolean('email')->default(0);
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
        Schema::dropIfExists('permission_lists');
    }
}
