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
            
            <span>
            <img src="{{asset('img/nicebutton.png')}}" width="30px">
             
            <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
            @if(Auth::user()->stores()->where('store_id' , $store->id)->get()->count())
            <!-- 「いいね」取消用ボタンを表示 -->
            	<a href="{{ route('unlike', $store) }}" class="btn btn-success btn-sm">
            		いいね
            		<!-- 「いいね」の数を表示 -->
            		{{$store->users()->get()->count()}}
            	</a>
            @else
            <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
            	<a href="{{ route('like', $store) }}" class="btn btn-secondary btn-sm">
            		いいね
            		<!-- 「いいね」の数を表示 -->
            		{{$store->users()->get()->count()}}
            	</a>
            @endif
            </span>
            
            <p class="edit">[<a href="/stores/edit/{{ $store->id }}">編集</a>]</p>
            <form action="/stores/{{ $store->id }}" id="form_delete" method="post" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return deleteStore(this);">削除</button> 
            </form>
            <p></p>
            
            <div class="content__store">
                <h3　class="content_title">工芸の種類</h3>
                @foreach ($crafts as $craft)
                    <div class="content">{{$craft->type}}</div>
                @endforeach
                <p></p>
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
                    <div class="content">{{$payment->payment}}</div>
                @endforeach  
                <p></p>
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
                        document.getElementById('form_delete').submit();
                    }
                 }
            
            </script>
        </div>
        
        <div class="review">
            <h1>口コミ</h1>
            [<a href='/reviews/create/{{ $store->id }}'>投稿する</a>]
            <div class="reviews">
                @foreach ($reviews as $review)
                    <div class="review">
                        <a href="/stores/{{$review->id}}"><h2 classs="title">{{ $review->stars}}</h2></a>
                        <p class="body">{{$review->comment}}</p>
                    </div>
               @endforeach
                
            </div>
        </div>
        
    </body>
</html>