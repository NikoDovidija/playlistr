<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablesSetup extends Migration {

    public function up() {
        Schema::create("playlists", function (Blueprint $table) {
            $this->configure($table);
            $table->increments("playlist_id");
            $table->integer("user_id")->default(0);
            $table->char("name", 255)->default("My Playlist");
            $table->string("description")->nullable();
            $table->string("url")->default('/images/intervalsalbum.jpg');
            $table->integer("times_played")->default(0);
            $table->boolean("recommended")->default(false);
            $table->integer("favourites")->default(0);;
            $table->timestamps();
        });

        Schema::create("comments", function (Blueprint $table) {
            $this->configure($table);
            $table->increments("comment_id");
            $table->integer("response_to");
            $table->char("author", 25);
            $table->string("text");
            $table->integer("score")->default(0);
            $table->char("parent_type", 10);
            $table->timestamps();
        });

        Schema::create("songs", function (Blueprint $table) {
            $this->configure($table);    
            $table->increments("song_id");
            $table->integer("playlist_id");
            $table->string("song_url");
            $table->string("name");
            $table->string("artist")->nullable();
            $table->string("album", 255)->nullable();
            $table->integer("duration")->nullable();
            $table->integer("playcount")->default(0);
            $table->timestamps();
        });

        Schema::create("artwork", function (Blueprint $table) {
            $this->configure($table);    
            $table->increments("artwork_id");
            $table->integer("playlist_id");
            $table->string("url", 255);
            $table->timestamps();
        });

        Schema::create("users", function (Blueprint $table) {
            $this->configure($table);    
            $table->increments("user_id");
            $table->string("name",255);
            $table->string("email", 255);
            $table->string("password", 255);
            $table->string("remember_token",255)->nullable();
            $table->timestamps();
        });


    }

    public function down() {
        Schema::dropIfExists("playlists");
        Schema::dropIfExists("comments");
        Schema::dropIfExists("songs");
        Schema::dropIfExists("artwork");
        Schema::dropIfExists("users");
    }

    public function configure(Blueprint $table) {
        $table->charset = "utf8";
        $table->collation = "utf8_slovenian_ci";
    }
}
