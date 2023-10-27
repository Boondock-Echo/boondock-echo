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
        Schema::create('dockpacks', function (Blueprint $table) {
            $table->id();
            $table->integer('pack_id');
            $table->string('name', 45)->default('My New dock Pack');
            $table->jsonb('docks')->nullable();
            $table->string('description', 381)->nullable();
            $table->integer('owner')->nullable();
            $table->boolean('enabled')->default(1);
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
        Schema::dropIfExists('dockpacks');
    }
};
