@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

<div class="grid grid-wide">
    <div class="grid-item grid-left">
        <c-header></c-header>
    </div>
    <div class="grid grid-col grid-right iconsOuterHolder">
        <span class="iconsHolder">
            <i class="icon-plus btn btn2"></i>
        </span>
        <span class="iconsHolder">
            <i class="icon-search btn btn2"></i>
        </span>
    </div>
</div>
<div class="grid grid-full">

    <c-playlist-slider api-get="/"></c-playlist-slider>

</div>
@endsection