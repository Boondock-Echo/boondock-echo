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
        Schema::create('radio_reference_db', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('county');
            $table->string('city');
            $table->string('zip');
            $table->string('frequency');
            $table->string('license');
            $table->string('type');
            $table->string('tone');
            $table->string('alpha_tag');
            $table->string('description');
            $table->string('mode');
            $table->string('tag');
            // You can add more fields as needed.

            $table->timestamps(); // Adds created_at and updated_at columns.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radio_reference_db');
    }
};
