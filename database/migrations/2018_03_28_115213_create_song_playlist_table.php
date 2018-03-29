<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongPlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("song_playlist", function (Blueprint $table) {
            $table->charset = "utf8";
            $table->collation = "utf8_slovenian_ci";

            $table->integer("song_id");
            $table->integer("playlist_id");
            $table->timestamps();

            $table->primary(["song_id", "playlist_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("song_playlist");
    }
}
