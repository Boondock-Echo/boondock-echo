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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('station');
            $table->unsignedBigInteger('category_id');
            $table->string('frequency');
            $table->boolean('rx_enabled');
            $table->unsignedBigInteger('user_id');
            $table->boolean('tx_enabled');
            $table->text('description')->nullable();
            $table->text('auto_transcribe')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station');
    }
};
