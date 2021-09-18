<?php

namespace App\Http\Controllers;

use App\Review;
use App\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    
    public function create($store_id)
    {
        //if($user->id === $review->id){
            // return redirect('/stores/' . $store_id);
        // }
        
        return view('review/create')->with(['store_id' => $store_id]);
    }
    
    public function store(Request $request, Review $review, $store_id)
    {
        $review_input = $request['review'];
        
        $review->store_id = $store_id;
        $review->user_id = Auth::id();
        $review->fill($review_input)->save();
        
        return redirect('/stores/' . $store_id);
    }
    
    public function edit(Review $review, Store $store)
    {
        $checked=['', '', '', '', '', ''];
        $checked[$review->stars]='checked';
        
        return view('review/edit')->with(['review' => $review, 'store' => $store, 'checked' => $checked]);
    }
    
    public function update(Request $request, Review $review, Store $store)
    {
        $review_input = $request['review'];
    
        $review->fill($review_input)->save();
        
        return redirect('/stores/' . $review->store_id);
    }
    
    public function destroy(Review $review, Store $store)
    {
        $review->delete();
        return redirect('/stores/' . $review->store_id);
    }
}
