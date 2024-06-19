<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('user_failed_login_attempts', function (Blueprint $table) {
            $table->bigIncrements('ufla_id');
            $table->string('ufla_device_name');
            $table->dateTime('ufla_last_attempt')->nullable();
            $table->unsignedBigInteger('ufla_failed_attempts')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_failed_login_attempts');
    }
};
