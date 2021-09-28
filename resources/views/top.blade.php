<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>top</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link rel="stylesheet" type="text/css" href="../css/top.css" />
        <script src="../js/top.js"></script>
        
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
                <a href="/"><img src="/images/b2e20892a1a73754f01bfb78d9848c03_d7ad8887-8e22-4d80-be75-fe236b677c4f_50x@2x.webp" width="60px"></a>
            </div>
            
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
                <div class="craft-type">
                    <img src="/images/493851AF-99FD-4E93-91AB-93884FACAF99_1080x.webp">
                    <h2>竹細工</h2>
                </div>
                <div class="craft-type">
                    <img src="/images/download.jpg">
                    <h2>染物</h2>
                </div>
                <div class="craft-type">
                    <img src="/images/3faf9464-515b-4eaa-8e36-40344245fe3e.webp">
                    <h2>陶芸</h2>
                </div>
                <div class="craft-type">
                    <img src="/images/image_050aedd3-2e1d-4cd0-b42c-cef88491a301_590x.webp">
                    <h2>漆芸</h2>
                </div>
                <div class="craft-type">
                    <img src="/images/unnamed.jpg">
                    <h2>木工</h2>
                </div>
                
            </div>
            
            <div class="stores">
                <h3>[<a href='/stores/index'>登録店舗一覧へ</a>]</h3>
            </div>
            
       
            
        </div>
    </body>
</html>