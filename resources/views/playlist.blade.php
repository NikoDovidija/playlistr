@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

<div class="grid grid-full">

    <div class="grid grid-full grid-left grid-col">
        <c-header></c-header>
        <c-record></c-record>
    </div>

    <div class="grid grid-full grid-right">
        <div class="grid grid-col grid-full">
                <div class="playlist-header grid grid-col grid-center">
                        <div class="playlist-name">Progressive metal playlist</div>
                        <div class="playlist-creator">by Jon Petruccio</div>
                    </div>
            <c-top-nav></c-top-nav>
            <c-scroll-list api-get="{{ Request::path().'/songs' }}"></c-scroll-list>
            <c-player :song-url="'{{$songUrl}}'"></c-player>
        </div>
    </div>


</div>

@endsection