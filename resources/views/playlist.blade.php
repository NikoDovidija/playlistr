@extends("layouts/main")

@section("title", $playlist)

@section("content")

<playlist-component api-get="{{ Request::path() }}"></playlist-component>

@endsection