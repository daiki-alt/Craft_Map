<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>shop_create</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
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

            <h1>店舗一覧画面</h1>
            [<a href='/stores/create'>新規店舗入力</a>]
            <div class='stores'>
                @foreach ($stores as $store)
            <div class="store">
                <a href="/stores/{{$store->id}}"><h2 classs="title">{{ $store->name}}</h2></a>
                <p class="body">{{$store->body}}</p>
            </div>
               @endforeach
            </div>
                
            <div class='paginate'>
                {{ $stores->links() }}
            </div>
             
   
            
            </div>
        </div>
    </body>
</html>
