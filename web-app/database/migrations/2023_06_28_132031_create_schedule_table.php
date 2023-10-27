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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->integer('dock_id');
            $table->string('job_id', 255)->nullable();
            $table->integer('user_id');
            $table->string('type')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->dateTime('scheduled_datetime')->nullable();
            $table->integer('day_of_month')->nullable();
            $table->string('week_day')->nullable();
            $table->boolean('is_enabled')->nullable();
            $table->string('task')->nullable();
            $table->string('task_name')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('schedule');
    }
};
