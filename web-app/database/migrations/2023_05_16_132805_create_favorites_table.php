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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->integer('message_id')->nullable();
            $table->text('description')->nullable();
            $table->string('mac', 45)->nullable();
            $table->integer('length')->nullable();
            $table->string('file_name', 45)->nullable();
            $table->timestamp('added')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('sent')->nullable();
            $table->integer('queued')->default(0);
            $table->string('station', 45)->nullable();
            $table->float('frequency')->nullable();
            $table->integer('played')->default(0);
            $table->integer('transcribed')->default(0);
            $table->string('transcribe_short', 100)->nullable();
            $table->text('transcribe_long')->nullable();
            $table->integer('deleted')->default(0);
            $table->integer('is_stt')->default(0);
            $table->integer('is_recorded')->default(0);
            $table->string('audio_type', 45)->nullable();
            $table->integer('audio_type_transcribed')->default(0);
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
        Schema::dropIfExists('favorites');
    }
};
