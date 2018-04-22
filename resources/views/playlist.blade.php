@extends("layouts/main")

@section("title", "Playlistr")

@section("content")

<div class="grid grid-full">

    <div class="grid grid-full grid-left grid-col">
        <c-header></c-header>
        <c-record></c-record>
    </div>

    <div class="grid grid-full grid-right">
        <div class="grid grid-center grid-full">
            <c-scroll-list api-get="{{ Request::path().'/songs' }}"></c-scroll-list>
        </div>
    </div>

    {{-- <div class="grid grid-col grid-left grid-stretch">
        <c-header></c-header>
    
        <c-record></c-record>

    </div>

    <div class="grid grid-col grid-right grid-stretch">
            <c-header></c-header>
    
            <c-record></c-record>
    </div> --}}

</div>

{{-- <c-player :song-url="'{{$songUrl}}'"></c-player>
<c-playlist api-get="{{ Request::path() }}"></c-playlist> --}}

@endsection