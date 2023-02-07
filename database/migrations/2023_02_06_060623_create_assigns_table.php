<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('assigns')) {

        Schema::create('assigns', function (Blueprint $table) {
            // $table->foreign('task_id')->references('id')->on('task')->onDelete('cascade');
            // $table->foreign('assigned_to')->references('u_id')->on('FormData')->onDelete('cascade');
            $table->id();
            $table->unsignedBigInteger('task_id');

            $table->unsignedBigInteger('user_id');
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigns');
    }
};
