<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Storage;

Route::middleware("auth")->post("/create", "playlistController@create");
Route::middleware("auth")->get("/playlists/user/{id}", "playlistController@fromUser");
Route::middleware("auth")->post("/playlists/{id}/removePlay", "playlistController@removePlaylist");
Route::middleware("auth")->post("/songs/{id}/removeSong", "songController@removeSong");
Route::middleware("auth")->post("/songs/{id}/editSong", "songController@editSong");

Route::get('/', function () {
    return view('landing', [
            "playlists" => app(PlaylistController::class)->index(),
        ]
    );
});

Route::get('/ref', function () {
    return back();
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::middleware("auth")->get('/profile', function () {
    return view('profile');
});

Route::middleware("auth")->get('/logout',function(){
    Auth::logout(); 
    return view('auth.login');
});


 Route::get('/playlists/{id_playlist}', function ($id_playlist) {
     return view('playlist', [
             "comments" => app(PlaylistController::class)->getComments($id_playlist),
             "songurls" => app(SongController::class)->returnUrls($id_playlist),
             "playlistInfo" => app(PlaylistController::class)->getPlaylist($id_playlist),
             "creator" => app(PlaylistController::class)->getCreator($id_playlist),
         ]
     );
 });


Auth::routes();
