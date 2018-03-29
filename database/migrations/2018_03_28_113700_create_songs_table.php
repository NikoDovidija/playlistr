<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("songs", function (Blueprint $table) {
            $table->charset = "utf8";
            $table->collation = "utf8_slovenian_ci";

            $table->increments("song_id");
            $table->char("name", 255);
            $table->char("artist", 255)->nullable();
            $table->char("album", 255)->nullable();
            $table->string("artwork")->nullable();
            $table->integer("duration")->nullable();
            $table->integer("playcount")->default(0);
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
        Schema::dropIfExists("songs");
    }
}
