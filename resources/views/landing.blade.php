@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

    <div class="grid grid-wide grid-top">
            <c-header></c-header>
        <div class="grid grid-col grid-right iconsOuterHolder">
            <span class="iconsHolder">
                <i class="icon-plus btn btn2"></i>
            </span>
            <span class="iconsHolder">
                <i class="icon-search btn btn2"></i>
            </span>
        </div>
    </div>
    <div class="playlist-slider grid grid-full">

        <c-playlist-slider api-get="/"></c-playlist-slider>

    </div>

@endsection