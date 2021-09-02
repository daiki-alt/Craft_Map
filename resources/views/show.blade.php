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
        <h3　class="content_title"></h3>
        
        <div class="content">
            <div class="content__store">
                <h1>{{ $store->name }}</h1>    
            </div>
            <p class="edit">[<a href="/stores/{{ $store->id }}/edit">編集</a>]</p>
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
                function deleteStore(e){
                                            'use strict';
                                            if(confirm('削除すると復元できません。\n本当に削除しますか？')){
                                                document.getElementById('form_delete').submit();
                                            }
                                       }
            
            </script>
        </div>
        
        
    </body>
</html>