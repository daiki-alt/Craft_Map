<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Store $store)
    {
        $store->users()->attach(Auth::id());
        
        return redirect('/stores/' . $store->id);
    }
    
    public function unlike(Store $store)
    {
        $store->users()->detach(Auth::id());
        
        return redirect('/stores/' . $store->id);
    }
}
