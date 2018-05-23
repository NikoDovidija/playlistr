<?php

use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/","playlistController@index");
Route::get("/mostfavourite", "playlistController@mostFavourite");
Route::get("/recommended", "playlistController@recommended");


Route::get("/songs", "songController@index");
Route::post("/songs/add", "songController@create");
Route::get("songs/{id}", "songController@getById");

Route::get("/comments", "commentController@index");
Route::post("/comments", "commentController@create");
Route::get("/comments/{id}", "commentController@getById");


Route::get("/playlists/{id}/songs", "playlistController@getSongs");
Route::get("/playlists/{id}/comments", "playlistController@getComments");
Route::post("/playlists/{id}/removePlay", "playlistController@removePlaylist");

Route::post("/playlists/{id}/upload/mp3","UploadController@uploadMusic");

Route::get("/playlists/{id}", "playlistController@getById");
Route::get("/playlists/url/{id}", "playlistController@imageUrl");
Route::post("/{id}/incrementFav", "playlistController@incrementFav");

Route::get('/upload', 'UploadController@uploadForm');
Route::post('/upload', 'UploadController@uploadSubmit');
Route::post('/upload/thumbnail','UploadController@uploadThumbnail');
Route::post('/upload/removeThumbnail','UploadController@removeThumbnail');