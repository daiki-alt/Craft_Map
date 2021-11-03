<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>shop_create</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/store_index.css') }}" />
    </head>
    <body>
        <div class="menu"> 
            <div class="logo">
                <a href="/"><img src="/images/b2e20892a1a73754f01bfb78d9848c03_d7ad8887-8e22-4d80-be75-fe236b677c4f_50x@2x.webp"></a>
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
                    <li><a href='/stores/index'>登録店舗一覧</a></li>
                    @if(Auth::id() === 1)
                        <li><a href='/stores/create'>新規店舗入力</a></li>
                    @endif
                </ul>
            </nav>
        </div>
            
        <div class="title">
            <h1>【 お気に入り店舗 】</h1>
        </div>
            
        <div class="count">
            <h4>{{ $stores->count() }}件が見つかりました。</h4>
        </div>
            
        <div class='stores'>
            @foreach ($stores as $store)
                <div class="store">
                    @if($store_image)
                        @if($store->store_images()->first()->photo_path)
                            <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $store->store_images()->first()->photo_path }}" >
                        @endif
                        <a href="/stores/{{ $store->id }}"><h2 classs="title">{{ $store->name }}</h2></a>
                    @endif
                </div>
           @endforeach
        </div>
        
        @extends('footer')
    </body>
</html>
