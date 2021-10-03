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
        
        <!-- jQuery読み込み -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 
        <!-- Propper.js読み込み -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
         
        <!-- BootstrapのJavascript読み込み -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head></script>
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

            <div class="content">
                <div class="title m-b-md">
                    <label class="col-sm-2 control-label"><h3>新規店舗入力</h3></label>
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
                                <input class="form-control" type="text" name="store[address]">
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
        <div class="back">[<a href="/stores/index">店舗一覧画面に戻る</a>]</div>
    </body>
</html>
