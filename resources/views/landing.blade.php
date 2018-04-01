@extends("layouts/main")

@section("title", "PlaylistR")

@section("content")

<playlist-component :playlists="{{ json_encode($playlists) }}"></playlist-component>

@endsection