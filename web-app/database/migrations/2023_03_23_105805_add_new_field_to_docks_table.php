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
            $table->boolean('speaker')->default(1);
            $table->float('auto_rec_sound_lv')->default(1.0);
            $table->boolean('notification')->default(1);
            $table->boolean('line_in_stereo')->default(0);
            $table->boolean('line_in_channel')->default(0);
            $table->float('line_in_min_db')->default(1.0);
            $table->integer('line_in_gain')->default(3);
            $table->boolean('ptt_stereo')->default(0);
            $table->boolean('ptt_channel')->default(1);
            $table->float('ptt_min_db')->default(1.0);
            $table->integer('ptt_gain')->default(3);
            $table->text('address')->nullable();
            $table->integer('category')->nullable()->default(1);
            $table->boolean('in_use')->default(0);
            $table->integer('dock_pack_id')->nullable();
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
