<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceCodesTable extends Migration
{
    public function up()
    {
        Schema::create('device_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('status')->default(0);
            $table->integer('dock_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('license_type')->default(1);
            $table->integer('storage_type')->default(1);
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('device_codes');
    }
}
