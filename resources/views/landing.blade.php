@extends("layouts/main")

@section("title", "PlaylistR")

@section("content")

<playlists-component :playlists="{{ json_encode($playlists) }}"></playlists-component>

@endsection