<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/store_show.css') }}" >
        <script src="../js/store_show.js"></script>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
            
            <!--スライド表示-->
            <script type="text/javascript">
                    $(document).ready(function(){
                        $('.slider').bxSlider({
                            auto: true,
                            pause: 5000,
                        });
                    });
            </script>
    </head>
    <body>
        
        <div class="logo">
            <a href="/">
                <img src="/images/b2e20892a1a73754f01bfb78d9848c03_d7ad8887-8e22-4d80-be75-fe236b677c4f_50x@2x.webp" >
            </a>
        </div>
        
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                @if(Auth::id())
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
            </ul>
        </nav>
        
        <div class="content">
            <div class="content_store">
                <h1>～　{{ $store->name }}　～</h1>    
            </div>
            
            <div class="slider">
                @foreach($store->store_images()->get() as $image)
                    @if ($image['photo_path'])
                        <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}" >
                    @endif
                @endforeach
            </div>
            
            <span>
                <img src="/images/nicebutton.png" width="30px">
                
                @if(Auth::user())
                    <!--ユーザーが「いいね」をしていたら -->
                    @if(Auth::user()->stores()->where('store_id' , $store->id)->get()->count())
                    <!-- 「いいね」取消用ボタンを表示 -->
                    	<a href="/stores/unlike/{{ $store->id }}" class="btn btn-success btn-sm">
                    		いいね
                    		<!-- 「いいね」の数を表示 -->
                    		{{ $store->users()->get()->count() }}
                    	</a>
                    @else
                    <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                    	<a href="/stores/like/{{ $store->id }}" class="btn btn-secondary btn-sm">
                    		いいね
                    		<!-- 「いいね」の数を表示 -->
                    		{{ $store->users()->get()->count() }}
                    	</a>
                    @endif
                @else
                    <a onClick="alert('＊ログイン後、お気に入り登録がご利用いただけます')" class="btn btn-success btn-sm">
                		いいね
                		<!-- 「いいね」の数を表示 -->
                		{{ $store->users()->get()->count() }}
                	</a> 
                @endif
            </span>
            
            <p class="edit">[<a href="/stores/edit/{{ $store->id }}">編集</a>]</p>
            
            <form action="/stores/{{ $store->id }}" id="form_delete1" method="post" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return deleteStore('form_delete1');">削除</button> 
            </form>
            
            <div class="content__store">
                <h3　class="content_title">工芸の種類</h3>
                @foreach ($crafts as $craft)
                    <div class="content">
                        {{ $craft->type }}
                    </div>
                @endforeach
                <br>
            </div>
            
            <div class="content__store">
                <h3　class="content_title">営業形態</h3>
                <p>{{ $store->work_type }}</p>    
            </div>
            
            <div class="content__store">
                <h3　class="content_title">住所</h3>
                <p>{{ $store->address }}</p>    
            </div>
            
            <div class="content__store">
                <h3　class="content_title">電話番号</h3>
                <p>{{ $store->telephone_number }}</p>    
            </div>
            
            <div class="content__store">
                <h3　class="content_title">営業時間</h3>
                <p>{{ substr($store->start_hours,0,5) }}～{{ substr($store->end_hours,0,5) }}</p>     
            </div>
            
            <div class="content__store">
                <h3　class="content_title">支払い方法</h3>
                @foreach ($payments as $payment)
                    <div class="content">
                        {{ $payment->payment }}
                    </div>
                @endforeach  
            </div>
        </div>
        
        <!--google map表示-->
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
        
        <div class="review-list">
            <h1>～　口コミ　～</h1>
            
            @if($self_review)
                <a class="btn btn-success btn-sm" href="/reviews/edit/{{ $self_review->id }}">編集する</a>
                
                <form action="/reviews/{{ $self_review->id }}" id="form_delete2" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return deleteStore('form_delete2');">削除</button> 
                </form>
            @elseif(Auth::id())
                <a href='/reviews/create/{{ $store->id }}'>投稿する</a>
            @else
                <a onClick="alert('＊ログイン後、レビュー投稿がご利用いただけます')">投稿する</a>
            @endif
            
            <div class="reviews">
                @if($self_review)
                    <div class="review">
                        <p>{{ $user->name }}</p>
                        @for($star = 1; $star <= $self_review->stars; $star++)
                            <span style="color:#ffcc00;">★</span>
                        @endfor
                        <p>{{ $self_review->comment }}</p>
                        <div class="image-wrapper">
                            @foreach($self_review->images()->get() as $image)
                                @if ($image['photo_path'])
                                  <img class="review-image"  src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}" >
                                @endif
                            @endforeach
                        </div>
                        
                    </div>
                @endif
                
                @if($nonself_reviews)
                    @foreach ($nonself_reviews as $review)
                        <div class="review">
                            <p>{{ $review->users->name }}</p>
                            @for($star = 1; $star <= $review->stars; $star++)
                                <span style="color:#ffcc00;">★</span>
                            @endfor
                            <p class="body">{{ $review->comment }}</p>
                            <div class="image-wrapper">
                                @foreach($review->images()->get() as $image)
                                    @if ($image['photo_path'])
                                      <img class="review-image" src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach 
                @endif
            </div>
        </div>
        
        <div class="back">
            <a href="/stores/index">店舗一覧画面に戻る</a>
        
            <script>
                function deleteStore(form)
                {
                    'use strict';
                    
                    if(confirm('削除すると復元できません。\n本当に削除しますか？'))
                    {
                        document.getElementById(form).submit();
                    }
                }
                
            </script>
        </div>
    </body>
</html>