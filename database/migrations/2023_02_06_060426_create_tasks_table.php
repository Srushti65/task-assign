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

        if(!Schema::hasTable('tasks')) {

        Schema::create('tasks', function (Blueprint $table) {

            $table->id('t_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('owner')->nullable();
            $table->foreign('owner')->references('u_id')->on('form_data')->nullable();

            // $table->string('owner')->nullable();
            // $table->string('assigned_to')->nullable();
            
            $table->date('created_at')->nullable();
            $table->date('due_date')->nullable();
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
        Schema::dropIfExists('tasks');
    }
};
