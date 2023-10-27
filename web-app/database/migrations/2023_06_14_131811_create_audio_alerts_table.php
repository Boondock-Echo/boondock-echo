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
        Schema::create('audio_alerts', function (Blueprint $table) {
            $table->id();
            $table->text('audio_array');
            $table->integer('dock_id');
            $table->integer('owner_id');
            $table->boolean('email_alert')->default(false);
            $table->timestamps();

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
        Schema::dropIfExists('audio_alerts');
    }
};
