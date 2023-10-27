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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profile_picture')->nullable();
            $table->string('company')->nullable();
            $table->string('last_name')->nullable();
            $table->boolean('live_mode')->nullable();
            $table->boolean('original_audio')->nullable();
            $table->boolean('dark_mode')->nullable();
            $table->string('email')->unique();
            $table->string('nick_name')->nullable();
            $table->string('timezone')->default('America/Chicago')->nullable();
            $table->string('address', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->string('zip', 10)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

                        
            // License Fields
            $table->string('license_status')->nullable();
            $table->date('license_expiration_date')->nullable();
            $table->string('license_type')->nullable();
            $table->string('license_name')->nullable();
            $table->string('call_sign')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
