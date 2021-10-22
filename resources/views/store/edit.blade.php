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
        <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
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
                    <label class="col-sm-2 control-label"><h3>店舗編集</h3></label>
                </div>
                
                <form action="/stores/{{ $store->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="container">
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">店舗名</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="store[name]" value="{{ $store->name }}">
                            </div>
                        </div>
                      
                    <div class="form-group">
                        <label class="col-sm-2 control-label">工芸の種類</label>
                        <div class="col-sm-10">
                            @foreach ($crafts as $craft)
                                <div class="form-check form-check-inline">
                                    @if($craft->is_selected)
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="craft[]" value="{{ $craft->id }}" checked>{{ $craft->type }}
                                        </label>
                                    @else                                        
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="craft[]" value="{{ $craft->id }}">{{ $craft->type }}
                                        </label>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">店舗形態</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="store[work_type]" value="{{ $store->work_type }}">
                                <option value="販売">販売</option>
                                <option value="体験">体験</option>
                                <option value="販売と体験">販売と体験</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">住所</label>
                        <div class="col-sm-10">
                            <input type="text" id="addressInput" name="store[address]" value="{{ $store->address }}">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label">緯度経度</label>
                        <div class="col-sm-10">
                            <button id="searchGeo" type="button">緯度経度変換</button>
                            緯度：<input type="text" id="lat" name="store[lat]" value="{{ $store->lat }}">
                            経度：<input type="text" id="lng" name="store[lng]" value="{{ $store->lng }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">電話番号</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="store[telephone_number]" value="{{ $store->telephone_number }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">営業時間</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="time" name="store[start_hours]" value="{{ $store->start_hours }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">営業時間</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="time" name="store[end_hours]" value="{{ $store->end_hours }}">
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label class="col-sm-2 control-label">支払い方法</label>
                        <div class="col-sm-10">
                            @foreach ($payments as $payment)
                                <div class="form-check form-check-inline">
                                    @if($payment->is_selected)
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="payment[]" value="{{ $payment->id }}" checked>{{ $payment->payment }}
                                        </label>
                                    @else
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="payment[]" value="{{ $payment->id }}">{{ $payment->payment }}
                                        </label>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">選択された画像</label>
                        <div class="col-sm-10">
                            @if($images)
                                @foreach ($images as $image)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="store_images[]" value="{{ $image['photo_path'] }}" >
                                            <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}" width="400px" height="400px">
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">新しく追加する画像</label>
                        <div class="col-sm-10">
                            <input type="file" name="store_photo[]" multiple="multiple">
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="更新"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="back">[<a href="/">back</a>]</div>
        
        <!--googleapiキー読み込み-->
        <script
            src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemap.api_key') }}"
            async
        ></script>
        <script src="../../js/store_create.js"></script>
        
    </body>
</html>
