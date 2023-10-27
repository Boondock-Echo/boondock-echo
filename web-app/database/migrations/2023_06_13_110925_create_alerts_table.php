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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dock_id')->nullable();
            $table->unsignedBigInteger('message_id')->nullable();
            $table->text('message');
            $table->text('keywords')->nullable();
            $table->text('audio_url')->nullable();
            $table->string('alert_type');
            $table->boolean('alerts_seen')->default(false);
            $table->string('alert_mood')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('dock_id')->references('id')->on('docks')->onDelete('cascade');
        });
        
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerts');
    }
};
