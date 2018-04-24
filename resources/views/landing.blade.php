@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

<div class="grid grid-wide">
<div class="grid-item">
    <c-header></c-header>
</div>
</div>
<div class="grid grid-full">
<div class="grid-item grid-wide grid-center">
<c-playlist-slider></c-playlist-slider>

</div>
</div>
@endsection