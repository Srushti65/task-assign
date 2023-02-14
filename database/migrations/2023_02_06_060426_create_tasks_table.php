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

        if (!Schema::hasTable('tasks')) {

            Schema::create('tasks', function (Blueprint $table) {

                $table->id('t_id');
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->unsignedBigInteger('owner_id');
                $table->string('assigned_to')->nullable();
                $table->softDeletes();
                $table->date('created_at')->nullable();
                $table->date('due_date')->nullable();
                $table->boolean('is_completed')->default(0);
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
