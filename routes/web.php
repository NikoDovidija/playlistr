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
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('landing', [
            "playlists" => app(PlaylistController::class)->index(),
        ]
    );
});

 Route::get('/playlists/{id_playlist}', function ($id_playlist) {
     return view('playlist', [
             "songs" => app(PlaylistController::class)->getById($id_playlist),
             "comments" => app(PlaylistController::class)->getComments($id_playlist)
         ]
     );
 });


Route::get('/playlists/{id_playlist}', function ($id_playlist) {
    return view("playlist", [
        "songUrl" => "/public".Storage::url("Intervals - Fable.mp3")
    ]);
});
