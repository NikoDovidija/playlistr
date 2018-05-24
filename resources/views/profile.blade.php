@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

    <div class="grid grid-wide grid-wrap">
        <c-header></c-header>
        <div class="grid grid-col grid-right iconsOuterHolder">
            <span data-open-modal="add-playlist" class="iconsHolder">
                <i class="icon-icons8-plus-math btn btn2"></i>
            </span>
            <span data-open-modal="search-playlist" class="iconsHolder">
                <i class="icon-icons8-search btn btn2"></i>
            </span>
            <span class="iconsHolderLogin">
                <i class="icon-user-plus btn btn2"></i>
            </span>
        </div>
        <div class="playlist-slider grid grid-full">
        <c-playlist-slider get="{{'playlists/user/'.Auth::user()->user_id}}" ref="sldr2" :profile='1' ></c-playlist-slider>
        </div>
        
    </div>


@endsection