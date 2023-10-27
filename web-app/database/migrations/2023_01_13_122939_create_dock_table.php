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
        Schema::create('docks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10)->nullable();
            $table->string('mac', 45)->nullable();
            $table->string('name', 45)->default('My new Boondock Echo');
            $table->string('sw_version', 5)->default('1.0');
            $table->string('hw_version', 10)->default('ait');
            $table->timestamp('last_online')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('is_online')->default(1);
            $table->string('city', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->string('zip', 10)->nullable();
            $table->float('lat')->nullable();
            $table->float('lon')->nullable();
            $table->integer('owner')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->timestamp('last_seen')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('station', 45)->default('Station Name');
            // $table->float('frequency')->default(1);
            $table->decimal('frequency', 8, 3)->default(1)->unsigned();
            $table->boolean('rx_enabled')->default(1);
            $table->boolean('tx_enabled')->default(0);
            $table->boolean('setting_speaker_out')->default(0);
            $table->integer('setting_silence')->default(3000);
            $table->integer('setting_audio_trigger')->default(50);
            $table->integer('setting_speaker_volume')->default(50);
            $table->integer('setting_max_recording')->default(10);
            $table->integer('setting_min_recording')->default(1);
            $table->timestamp('code_expiry')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unique('mac');
            $table->unique('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dock');
    }
};
