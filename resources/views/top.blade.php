<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>top</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/top.css') }}"/>
        <script src="../js/top.1.js"></script>
        
        <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
        
    </head>
    <body>
        <div class="logo">
            <a href="/"><img src="/images/b2e20892a1a73754f01bfb78d9848c03_d7ad8887-8e22-4d80-be75-fe236b677c4f_50x@2x.webp" width="60px"></a>
        </div>
            
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                @if(Auth::user())
                    <li><a href="{{ url('/home') }}">ログアウト</a></li>
                @else
                    <li><a href="{{ route('login') }}">ログイン</a></li>
                    <li><a href="{{ route('register') }}">新規登録</a></li>
                @endif
                <li><a href="//takutaku-online.com">オンラインショップ</a></li>
                @if(Auth::user())
                    <li><a href="/stores/user/like">お気に入り店舗</a></li>
                @else
                    <li><a onClick="alert('＊ログイン後、お気に入り登録がご利用いただけます')">お気に入り店舗</a></li>
                @endif
                <li><a href="//takutaku-online.com/blogs/ニュース/匠宅からのお知らせ">お知らせ</a></li>
                @if(Auth::id() === 1)
                    <li><a href='/stores/index'>登録店舗一覧</a></li>
                @endif
            </ul>
        </nav>
            
        <div class="title">
            <h1>～　静岡市工芸品マップ　～</h1>
        </div>
            
        <input
            id="pac-input"
            class="controls"
            type="text"
            placeholder="Search Box"
        />
        <div id="map"></div>
        
        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
        <script
            src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemap.api_key') }}&callback=initAutocomplete&libraries=places&v=weekly"
            async
        ></script>
        
        <div class="content-title">
            <h2>～　工芸の種類別一覧　～</h2>
        </div>
            
        <div class="craft-types">
            @foreach($crafts as $craft)
                <div class="craft-type">
                    <img src="{{ $craft->image_file }}">
                    <a href="/stores/index/{{ $craft->id }}"><h2>{{ $craft->type }}</h2></a>
                </div>
            @endforeach
        </div>
        
        <div class="stores">
            <h3><a href='/stores/index'>登録店舗一覧へ</a></h3>
        </div>
            
        <!--<a href="//takutaku-online.com/blogs/ニュース/匠宅からのお知らせ">匠宅からのお知らせ</a>-->
        <!--<a href="//www.instagram.com/takutaku.shokunin/">Instagram</a>-->
    </body>
</html>