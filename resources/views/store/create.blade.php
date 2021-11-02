<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>shop_create</title>
　　　　
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        <!-- bootstrap読み込み -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/store_create.css') }}" />
        
        <!-- jQuery読み込み -->
        <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 
        <!-- Propper.js読み込み -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
         
        <!-- BootstrapのJavascript読み込み -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    </head></script>
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
        
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title">
                    <h2>【 新規店舗入力 】</h2>
                </div>
                
                <form action="/stores" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                
                        <div class="form-group">
                            <label class="col-sm-2 control-label">店舗名</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="store[name]" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">工芸の種類</label>
                            <div class="col-sm-10">
                                @foreach ($crafts as $craft)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="craft[]" value="{{ $craft->id }}">{{ $craft->type }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">店舗形態</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="store[work_type]">
                                    <option value="販売">販売</option>
                                    <option value="体験">体験</option>
                                    <option value="販売と体験">販売と体験</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">住所</label>
                            <div class="col-sm-10">
                                <input type="text" id="addressInput" name="store[address]">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">緯度経度</label>
                            <div class="col-sm-10">
                                <button id="searchGeo" type="button">緯度経度変換</button>
                                緯度：<input type="text" id="lat" name="store[lat]">
                                経度：<input type="text" id="lng" name="store[lng]">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">電話番号</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="store[telephone_number]">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">営業時間</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="time" name="store[start_hours]">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">営業時間</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="time" name="store[end_hours]">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">支払い方法</label>
                            <div class="col-sm-10">
                                @foreach ($payments as $payment)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="payment[]" value="{{ $payment->id }}">{{ $payment->payment }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">画像</label>
                            <div class="col-sm-10">
                                <input type="file" name="store_photo[]" multiple="multiple">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" value="保存"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        @extends('footer')
        
        <!--googleapiキー読み込み-->
        <script
            src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemap.api_key') }}"
            async
        ></script>
        <script src="../js/store_create.js"></script>
        
    </body>
</html>
