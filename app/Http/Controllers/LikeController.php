<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Store $store, Request $request){
        $like=New Like();
        $like->store_id=$store->id;
        $like->user_id=Auth::user()->id;
        $like->save();
        return back();
    }
    
    public function unlike(Store $store, Request $request){
        $user=Auth::user()->id;
        $like=Like::where('store_id', $store->id)->where('user_id', $user)->first();
        $like->delete();
        return back();
    }
}
