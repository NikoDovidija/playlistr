<?php

use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/", "playlistController@index");
Route::post("/create", "playlistController@create");

Route::get("/songs", "songController@index");
Route::post("/songs/add", "songController@create");

Route::get("/comments", "commentController@index");
Route::post("/comments", "commentController@create");
Route::get("/comments/{id}", "commentController@getById");

Route::get("/{id}", "playlistController@getById");