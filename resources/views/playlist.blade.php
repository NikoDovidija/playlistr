@extends("layouts/main")

@section("title", "Playlistr")

@section("content")


<c-player :song-url="'{{$songUrl}}'"></c-player>
<c-playlist api-get="{{ Request::path() }}"></c-playlist>

@endsection