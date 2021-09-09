<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    
    public function create(Review $review)
    {
        return view('review/create')->with(['reviews' => $review]);
    }
    
    public function store(Request $request, Review $review)
    {
        $review_input = $request['review'];
        $store_input = $request['store'];
        $user_input = $request['user'];
    
        $review->store_id = $request->store_id;
        $review->user_id = $request->user()->id;
        $review->fill($review_input)->save();
        
        return redirect('/stores/' . $review->id);
    }
}
