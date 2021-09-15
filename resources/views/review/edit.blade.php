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
        
        <style>
        .evaluation{
          display: flex;
          flex-direction: row-reverse;
          justify-content: center;
        }
        .evaluation input[type='radio']{
          display: none;
        }
        .evaluation label{
          position: relative;
          padding: 10px 10px 0;
          color: gray;
          cursor: pointer;
          font-size: 50px;
        }
        .evaluation label .text{
          position: absolute;
          left: 0;
          top: 0;
          right: 0;
          text-align: center;
          font-size: 12px;
          color: gray;
        }
        .evaluation label:hover,
        .evaluation label:hover ~ label,
        .evaluation input[type='radio']:checked ~ label{
          color: #ffcc00;
        }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="title m-b-md">
                <label class="col-sm-2 control-label"><h3>レビュー投稿</h3></label>
            </div>
                
            <form action="/reviews/{{ $review->store_id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="container">
                    
                    <div class="evaluation">
                        <input id="star1" type="radio" name="review[stars]" value="{{ $review->stars }}" />
                        <label for="star1"><span class="text">大変良い</span>★</label>
                        <input id="star2" type="radio" name="review[stars]" value="{{ $review->stars }}" />
                        <label for="star2"><span class="text">良い</span>★</label>
                        <input id="star3" type="radio" name="review[stars]" value="{{ $review->stars }}" />
                        <label for="star3"><span class="text">普通</span>★</label>
                        <input id="star4" type="radio" name="review[stars]" value="{{ $review->stars }}" />
                        <label for="star4"><span class="text">悪い</span>★</label>
                        <input id="star5" type="radio" name="review[stars]" value="{{ $review->stars }}" />
                        <label for="star5"><span class="text">大変悪い</span>★</label>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label">コメント</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name="review[comment]">{{ $review->comment }}</textarea>
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