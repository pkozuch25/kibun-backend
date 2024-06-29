<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('songs_in_playlist', function (Blueprint $table) {
            $table->bigIncrements('sip_id');
            $table->unsignedTinyInteger('sip_up_id');
            $table->string('sip_track_name');
            $table->string('sip_artist_name');
            $table->string('sip_track_image_url');
            $table->string('sip_artist_album_name');
            $table->bigInteger('sip_duration_ms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs_in_playlist');
    }
};
