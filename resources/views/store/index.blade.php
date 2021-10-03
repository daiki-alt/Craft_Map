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
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            
            <div class="logo">
                <a href="/">
                    <img src="/images/b2e20892a1a73754f01bfb78d9848c03_d7ad8887-8e22-4d80-be75-fe236b677c4f_50x@2x.webp" >
                </a>
            </div>
            
            <div class="title">
                <h1>店舗一覧</h1>
            </div>
            
            [<a href='/stores/create'>新規店舗入力</a>]
            
            <div class='stores'>
                @foreach ($stores as $store)
                    <div class="store">
                        <a href="/stores/{{ $store->id }}"><h2 classs="title">{{ $store->name }}</h2></a>
                        @foreach($store->store_images()->get() as $image)
                            @if ($image['photo_path'])
                                <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}" >
                            @endif
                        @endforeach
                    </div>
               @endforeach
            </div>
        </div>
    </body>
</html>
