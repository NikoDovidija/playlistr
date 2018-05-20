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

Route::get('/', function () {
    return view('landing', [
            "playlists" => app(PlaylistController::class)->index(),
        ]
    );
});

Route::get('/ref', function () {
    return back();
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

