<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="content">
            <div class="content__store">
                <h1>{{ $store->name }}</h1>    
            </div>
            
            @foreach($store->store_images()->get() as $image)
                @if ($image['photo_path'])
                    <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}">
                @endif
            @endforeach
            <br>
            
            <span>
                <img src="/images/nicebutton.png" width="30px">
                
                @if(Auth::user())
                    <!--ユーザーが「いいね」をしていたら -->
                    @if(Auth::user()->stores()->where('store_id' , $store->id)->get()->count())
                    <!-- 「いいね」取消用ボタンを表示 -->
                    	<a href="{{ route('unlike', $store) }}" class="btn btn-success btn-sm">
                    		いいね
                    		<!-- 「いいね」の数を表示 -->
                    		{{ $store->users()->get()->count() }}
                    	</a>
                    @else
                    <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                    	<a href="{{ route('like', $store) }}" class="btn btn-secondary btn-sm">
                    		いいね
                    		<!-- 「いいね」の数を表示 -->
                    		{{ $store->users()->get()->count() }}
                    	</a>
                    @endif
                @else
                    <a onClick="alert('＊ログイン後、お気に入り登録がご利用いただけます');" class="btn btn-success btn-sm">
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
                <button type="submit" onclick="return deleteStore(this);">削除</button> 
            </form>
            
            <div class="content__store">
                <h3　class="content_title">工芸の種類</h3>
                @foreach ($crafts as $craft)
                    <div class="content">{{ $craft->type }}</div>
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
                    <div class="content">{{ $payment->payment }}</div>
                @endforeach  
                <br>
            </div>
        </div>
        
        <div class="review-list">
            <h1>口コミ</h1>
            
            @if($self_review)
                <a class="btn btn-success btn-sm" href="/reviews/edit/{{ $self_review->id }}">編集する</a>
                
                <form action="/reviews/{{ $self_review->id }}" id="form_delete2" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return deleteReview(this);">削除</button> 
                </form>
            @elseif(Auth::id())
                <a href='/reviews/create/{{ $store->id }}' class="btn btn-success btn-sm">投稿する</a>
            @else
                <a class="btn btn-success btn-sm" onClick="alert('＊ログイン後、レビュー投稿がご利用いただけます');">投稿する</a>
            @endif
            
            <div class="reviews">
                <div class="review">
                    @if($self_review)
                        @for($star = 1; $star <= $self_review->stars; $star++)
                            <span style="color:#ffcc00;">★</span>
                        @endfor
                        <p>{{ $self_review->comment }}</p>
                        @foreach($self_review->images()->get() as $image)
                            @if ($image['photo_path'])
                              <!-- 画像を表示 -->
                              <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}">
                            @endif
                        @endforeach
                    @endif
                </div>
                
                <div class="review">
                    @foreach ($nonself_reviews as $review)
                        @for($star = 1; $star <= $review->stars; $star++)
                            <span style="color:#ffcc00;">★</span>
                        @endfor
                        <p class="body">{{ $review->comment }}</p>
                        @foreach($review->images()->get() as $image)
                            @if ($image['photo_path'])
                              <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}">
                            @endif
                        @endforeach
                    @endforeach    
                </div>
            </div>
        </div>
        
        <div class="footer">
            <a href="/">戻る</a>
        
            <script>
                function deleteStore(e)
                {
                    'use strict';
                    
                    if(confirm('削除すると復元できません。\n本当に削除しますか？'))
                    {
                        document.getElementById('form_delete1').submit();
                    }
                }
                
                function deleteReview(e)
                {
                    'use strict';
                    
                    if(confirm('削除すると復元できません。\n本当に削除しますか？'))
                    {
                        document.getElementById('form_delete2').submit();
                    }
                }
            </script>
        </div>
    </body>
</html>