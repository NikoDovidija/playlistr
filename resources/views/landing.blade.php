@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

    <div class="grid grid-wide grid-top">
        <c-header></c-header>

        <div class="grid grid-col grid-right iconsOuterHolder">
            @if (Auth::check())
            <span data-open-modal="add-playlist" class="iconsHolder">
                <i class="icon-icons8-plus-math btn btn2"></i>
            </span>
            <a href="/profile">
            <span class="iconsHolderLogin">
                <i class="icon-user-plus btn btn2"></i>
            </span>
            </a>
            <a href="/logout">
            <span class="iconsHolderLogin">
                <i class="icon-exit btn btn2"></i>
            </span>
            </a>
            @else
            <a href="/login">
            <span class="iconsHolderLogin">
                <i class="icon-login btn btn2"></i>
            </span>
            </a>
            @endif
            <span data-open-modal="search-playlist" class="iconsHolder">
                <i class="icon-icons8-search btn btn2"></i>
            </span>
        </div>
        <!-- <c-menu-options></c-menu-options> -->
    </div>
    <div class="playlist-slider grid grid-full">
        <c-playlist-slider api-get="/" ref="sldr" :profile='0' ></c-playlist-slider>
    </div>

@endsection