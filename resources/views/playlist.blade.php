@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

<div class="grid grid-full grid-col play-page">
<c-modal id="add-song"></c-modal>
    <div class="grid grid-full">
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
                    <div class="playlist-name">{{$playlistInfo->name}}</div>
                    <div class="playlist-creator">{{$creator->name}}</div>
                    <div class="playlist-social sm-only grid grid-half grid-center">
                        <span class="grid social-icon">
                            <i class="icon btn btn2 icon-favorite"></i>
                            <span>{{$playlistInfo->times_recommended}}</span>
                        </span>
                        <span class="grid social-icon">
                            <i class="icon btn btn2 btn icon-share2"></i>
                            <span></span>
                        </span>
                    </div>
                </div>
                @if (Auth::check())
                    @if ($creator->user_id === Auth::user()->user_id)
                    <c-top-nav :usrid="{{ Auth::user()->user_id }}"></c-top-nav>
                    @else
                    <c-top-nav></c-top-nav>
                    @endif
                @else
                <c-top-nav></c-top-nav>
                @endif
                <c-scroll-list api-get="{{ Request::path().'/songs' }}"></c-scroll-list>
                <c-comments api-get="{{ Request::path().'/comments' }}"></c-comments>
                <c-post-comment></c-post-comment>
            </div>
        </div>

    </div>

    <div class="grid grid-wide playercontentHolder">
        <c-social-player :playlistid="'{{$playlistInfo->playlist_id}}'" :favourites="'{{$playlistInfo->favourites}}'" :played="'{{$playlistInfo->times_played}}'"></c-social-player>
        <c-player :songurls="'{{$songurls}}'" ></c-player>
    </div>

</div>

@endsection