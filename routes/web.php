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

Route::get('/', function () {
    return view('landing', [
            "playlists" => app(PlaylistController::class)->index(),
        ]
    );
});

Route::get('/{id_playlist}', function ($id_playlist) {
    return view("playlist", [
        "playlist" => app(PlaylistController::class)->getPlaylist($id_playlist)->name,
    ]);
});
