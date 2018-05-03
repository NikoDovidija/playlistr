<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield("title")</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="https://cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
    </head>
    <body>
        <!-- <button data-open-modal="testmodal">open me</button> -->
        <div id="app">
            
            @yield("content")
            <c-modal id="add-playlist"></c-modal>
            <c-modal id="search-playlist"></c-modal>
        </div>

    <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>
