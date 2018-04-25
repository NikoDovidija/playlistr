@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

<div class="grid grid-wide">
    <div class="grid-item grid-left">
        <c-header></c-header>
    </div>
    <div class="grid grid-col grid-right iconsOuterHolder">
        <span class="iconsHolder">
            <i class="icon btn btn2">search</i>
        </span>
        <span class="iconsHolder">
            <i class="icon btn btn2">note_add</i>
        </span>
    </div>
</div>
<div class="grid grid-full">

    <c-playlist-slider></c-playlist-slider>

</div>
@endsection