@extends("layouts/main")

@section("title", "PlaylistR")

@section("content")

<div class="filter-container grid">
    <div class="filter-item grid grid-center">
        <div class="blur"></div>
        <span class="text">Top 10</span>
    </div>
    <div class="filter-item grid grid-center">
        <div class="blur"></div>
        <span class="text">Recommended</span>
    </div>
    <div class="filter-item grid grid-center">
        <div class="blur"></div>
        <span class="text">Random</span>
    </div>
</div>

<div class="grid">
    <c-list api-get="" heading="Most played today"></c-list>
    <c-list api-get="" heading="Recently created"></c-list>
</div>


<c-scroll-list api-get="" heading="Staff picks"></c-scroll-list>


@endsection