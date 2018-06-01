@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

    <div class="grid grid-wide grid-wrap">
        <c-header></c-header>
        <div class="grid grid-col grid-right iconsOuterHolder">
            <span data-open-modal="add-playlist" class="iconsHolder">
                <i class="icon-icons8-plus-math btn btn2"></i>
            </span>
            <span class="iconsHolderLogin">
            <a href="/logout">
                <i class="icon-exit btn btn2"></i>
                </a>
            </span>
        </div>
        <div class="playlist-slider grid grid-full">
        <c-playlist-slider get="{{'playlists/user/'.Auth::user()->user_id}}" ref="sldr2" :profile='1' ></c-playlist-slider>
        </div>
        
    </div>


@endsection