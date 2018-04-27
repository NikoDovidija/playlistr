@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

<div class="grid grid-full grid-col play-page">



    <div class="grid grid-full grid-sm-start">

        <div class="grid grid-full grid-half grid-left grid-col grid-sm-start">
            <div class="grid grid-wide">
                <c-header></c-header>
                <span class="m-drawer-btn">
                    <i class="icon btn2 btn icon-next"></i>
                </span>
            </div>
            <c-record></c-record>
        </div>

        <div class="m-drawer grid grid-full grid-half grid-right">
            <div class="grid grid-col grid-full">
                    <span class="m-drawer-btn">
                            <i class="icon btn2 btn icon-back"></i>
                        </span>
                <div class="playlist-header grid grid-col grid-center">
                    <div class="playlist-name">Progressive metal playlist</div>
                    <div class="playlist-creator">by Jon Petruccio</div>
                    <div class="playlist-social sm-only grid grid-half grid-center">
                        <span class="grid social-icon">
                            <i class="icon btn icon-favorite"></i>
                            <span>312</span>
                        </span>
                        <span class="grid social-icon">
                            <i class="icon btn2 btn icon-share2"></i>
                            <span>56</span>
                        </span>
                </div>
                </div>
                <c-top-nav></c-top-nav>
                <c-scroll-list api-get="{{ Request::path().'/songs' }}"></c-scroll-list>
            </div>
        </div>

    </div>

    <div class="grid grid-wide playercontentHolder">
        <div class="playlist-social not-sm grid grid-half grid-center">
            <span class="grid social-icon">
                <i class="icon btn4 icon-like"></i>
                <span>312</span>
            </span>
            <span class="grid social-icon">
                <i class="icon btn4 icon-share"></i>
                <span>56</span>
            </span>
        </div>

        <c-player :song-url="'{{$songUrl}}'"></c-player>
    </div>

</div>

@endsection