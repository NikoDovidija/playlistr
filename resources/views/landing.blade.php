@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

<div class="grid grid-wide">
<div class="grid-item grid-left">
    <c-header></c-header>
</div>
<div class="grid-item grid-right iconsOuterHolder">
    <span class="grid grid-item iconsHolder">
        <i class="icon btn btn2">search</i>
    </span>
    <span class="grid grid-item iconsHolder">
        <i class="icon btn btn2">note_add</i>
    </span>
</div>
</div>
<div class="grid grid-full">
<div class="grid-item grid-wide">
<c-playlist-slider></c-playlist-slider>
</div>
</div>
@endsection