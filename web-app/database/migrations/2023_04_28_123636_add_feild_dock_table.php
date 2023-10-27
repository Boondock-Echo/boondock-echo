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
        Schema::table('docks', function (Blueprint $table) {
            $table->boolean('record_line_in')->default(1);
            $table->boolean('save_ptt_recording')->default(1);
            $table->float('notification_vol')->default(1.0);
            $table->float('playback_vol')->default(1.0);
            $table->text('description')->nullable();
            $table->string('auto_transcribe')->nullable();
            $table->string('auto_level')->nullable();
            $table->string('noise_reduction')->nullable();
            $table->boolean('upload_line_in')->default(1);
            $table->boolean('upload_ptt_recording')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docks', function (Blueprint $table) {
            //
        });
    }
};
