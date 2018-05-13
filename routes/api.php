<?php

use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/", "playlistController@index");
Route::post("/create", "playlistController@create");

Route::get("/songs", "songController@index");
Route::post("/songs/add", "songController@create");
Route::get("songs/{id}", "songController@getById");

Route::get("/comments", "commentController@index");
Route::post("/comments", "commentController@create");
Route::get("/comments/{id}", "commentController@getById");


Route::get("/playlists/{id}/songs", "playlistController@getSongs");
Route::get("/playlists/{id}/comments", "playlistController@getComments");
Route::get("/playlists/{id}", "playlistController@getById");

 
Route::get('/upload', 'UploadController@uploadForm');
Route::post('/upload', 'UploadController@uploadSubmit');
Route::post('/upload/thumbnail','UploadController@uploadThumbnail');
Route::post('/upload/removeThumbnail','UploadController@removeThumbnail');