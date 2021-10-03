<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>shop_create</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../css/review_edit.css" />
        
        <!-- bootstrap読み込み -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
        {{-- jQuery読み込み --}}
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 
        {{-- Propper.js読み込み --}}
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
         
        {{-- BootstrapのJavascript読み込み --}}
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        
        
    </head>
    <body>
        <div class="content">
            <div class="title m-b-md">
                <label class="col-sm-2 control-label"><h3>レビュー投稿</h3></label>
            </div>
                
            <form action="/reviews/{{ $review->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="container">
                    
                    <div class="evaluation">
                        <input id="star1" type="radio" name="review[stars]" value="5" {{ $checked[5] }} />
                        <label for="star1"><span class="text">大変良い</span>★</label>
                        
                        <input id="star2" type="radio" name="review[stars]" value="4" {{ $checked[4] }} />
                        <label for="star2"><span class="text">良い</span>★</label>
                        
                        <input id="star3" type="radio" name="review[stars]" value="3" {{ $checked[3] }} />
                        <label for="star3"><span class="text">普通</span>★</label>
                        
                        <input id="star4" type="radio" name="review[stars]" value="2" {{ $checked[2] }} />
                        <label for="star4"><span class="text">悪い</span>★</label>
                        
                        <input id="star5" type="radio" name="review[stars]" value="1" {{ $checked[1] }} />
                        <label for="star5"><span class="text">大変悪い</span>★</label>
                        <!--check配列は投稿画面で星を選択した数を表している-->
                    </div>
                   
                    <div class="form-group">
                        <h4 class="col-sm-2 control-label">コメント</h4>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name="review[comment]">{{ $review->comment }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <h4 class="col-sm-2 control-label">選択された画像</h4>
                        <div class="col-sm-10">
                            @if($images)
                                @foreach ($images as $image)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="images[]" value="{{ $image['photo_path'] }}" >
                                            <img src="https://map-image-backet.s3.ap-northeast-1.amazonaws.com/{{ $image['photo_path'] }}">
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <h4 class="col-sm-2 control-label">新しく追加する画像</h4>
                        <div class="col-sm-10">
                            <input type="file" name="photo[]" multiple="multiple">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="更新"/>
                        </div>
                    </div>
                </div>
            </form>
            
        <div class="back">[<a href="/stores/{{ $review->store_id }}">back</a>]</div>
    </body>
</html>
