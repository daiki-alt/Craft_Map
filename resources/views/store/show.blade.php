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
        
        <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
        
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
        
        <div class="store_title">
            <div class="store_name">
                <h1 id="name">～　{{ $store->name }}　～</h1>
                @if(Auth::id() === 1)
                    <div class="store_edit">
                        <a href="/stores/edit/{{ $store->id }}">編集</a>
                        <form action="/stores/{{ $store->id }}" id="form_delete1" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <a type="submit" onclick="return deleteStore('form_delete1');">削除</a> 
                        </form>
                    </div>
                @endif
            </div>
            
            <div class="like">
                <img src="/images/nicebutton.png">
                    
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
            </div>   
        </div>
        
        <div class="content">
            <div class="slider">
                @foreach($store->store_images()->get() as $image)
                    @if ($image['photo_path'])
                        <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}" >
                    @endif
                @endforeach
            </div>
            
            <div class="content_store">
                <h4>【　工芸の種類　】</h4>
                @foreach ($crafts as $craft)
                    <span>
                        {{ $craft->type }}
                    </span>
                @endforeach
                <br>
            </div>
            
            <div class="content_store">
                <h4>【　営業形態　】</h4>
                <p>{{ $store->work_type }}</p>    
            </div>
            
            <div class="content_store">
                <h4>【　住所　】</h4>
                <p id="address">{{ $store->address }}</p>    
            </div>
            
            <div class="content_store">
                <h4>【　電話番号　】</h4>
                <p>{{ $store->telephone_number }}</p>    
            </div>
            
            <div class="content_store">
                <h4>【　営業時間　】</h4>
                <p>{{ substr($store->start_hours,0,5) }}～{{ substr($store->end_hours,0,5) }}</p>     
            </div>
            
            <div class="content_store">
                <h4>【　支払い方法　】</h4>
                @foreach ($payments as $payment)
                    <span class="content">
                        {{ $payment->payment }}
                    </span>
                @endforeach  
            </div>
        </div>
        
        <div class="map_title">
            <h1>～　店舗マップ　～</h1>
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
            <h1>【　口コミ　】</h1>
            
            <div class=edit>
                @if($self_review)
                    <a href="/reviews/edit/{{ $self_review->id }}">編集</a>
                    
                    <form action="/reviews/{{ $self_review->id }}" id="form_delete2" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <a type="submit" onclick="return deleteStore('form_delete2');">削除</a>
                    </form>
                @elseif(Auth::id())
                    <a href='/reviews/create/{{ $store->id }}'>投稿する</a>
                @else
                    <a onClick="alert('＊ログイン後、レビュー投稿がご利用いただけます')">投稿する</a>
                @endif
            </div>
            
            
            <div class="reviews">
                @if($self_review)
                    <div class="review">
                        <div class="user_name">
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="star">
                            @for($star = 1; $star <= $self_review->stars; $star++)
                                <span style="color:#ffcc00;">★</span>
                            @endfor
                        </div>
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
                            <div class="user_name">
                                <span>{{ $review->users->name }}</span>
                            </div>
                            <div class="star">
                                @for($star = 1; $star <= $review->stars; $star++)
                                    <span style="color:#ffcc00;">★</span>
                                @endfor
                            </div>
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
            <a href="/">トップページへ</a>
        </div>
        
        @extends('footer')
        
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
    </body>
</html>