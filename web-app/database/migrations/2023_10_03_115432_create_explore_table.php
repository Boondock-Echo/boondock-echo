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
        Schema::create('explore', function (Blueprint $table) {
            $table->id();
            $table->string('Output_Freq', 50)->nullable();
            $table->string('Input_Freq', 50)->nullable();
            $table->decimal('Offset', 5, 2)->nullable();
            $table->string('Uplink_Tone', 255)->nullable();
            $table->string('Downlink_Tone', 255)->nullable();
            $table->string('Location', 255)->nullable();
            $table->string('County', 255)->nullable();
            $table->decimal('Lat', 10, 6)->nullable();
            $table->decimal('Long', 10, 6)->nullable();
            $table->string('Call', 20)->nullable();
            $table->string('Use', 255)->nullable();
            $table->string('Op_Status', 50)->nullable();
            $table->string('Mode', 50)->nullable();
            $table->string('Digital_Access', 50)->nullable();
            $table->string('EchoLink', 50)->nullable();
            $table->string('IRLP', 50)->nullable();
            $table->string('AllStar', 50)->nullable();
            $table->string('Coverage', 255)->nullable();
            $table->string('band', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->string('Status', 50)->nullable();
            $table->date('Last_Update')->nullable();
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
        Schema::dropIfExists('explore');
    }
};
