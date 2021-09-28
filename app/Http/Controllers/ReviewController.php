<?php

namespace App\Http\Controllers;

use App\Review;
use App\Store;
use App\Image;
use Storage;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    
    public function create($store_id)
    {
        return view('review/create')->with(['store_id' => $store_id]);
    }
    
    public function store(Request $request, Review $review, $store_id)
    {
        $review_input = $request['review'];
        
        $review->store_id = $store_id;
        $review->user_id = $request->user()->id;
        
        $review->fill($review_input)->save();
        
        $disk = Storage::disk('s3');
        $images = $request->file('photo');
        if($images){
            foreach ($images as $image) {
            $path = $disk->putFile('review_images', $image, 'public');
            
            Image::create([
                    'photo_path' => $path,
                    'review_id' => $review->id,
                ]);
            }    
        }
        
        return redirect('/stores/' . $store_id);
    }
    
    public function edit(Review $review, Store $store)
    {
        $checked=['', '', '', '', '', ''];
        $checked[$review->stars]='checked';
        
        $image=$review->images()->get();
    
        return view('review/edit')->with(['review' => $review, 'store' => $store, 'checked' => $checked, 'images' => $image]);
    }
    
    public function update(Request $request, Review $review, Store $store)
    {
        $review_input = $request['review'];
        
        $review->fill($review_input)->save();
        
        if($request['images']){
            $images=$request['images'];
            foreach($images as $image){
                Storage::disk('s3')->delete($image);
                Image::where('photo_path',$image)->delete();
            }
        }
        
        $disk = Storage::disk('s3');
        $images_new = $request->file('photo');
        if($images_new){
            foreach ($images_new as $image) {
            $path = $disk->putFile('review_images', $image, 'public');
            
            Image::create([
                    'photo_path' => $path,
                    'review_id' => $review->id,
                ]);
            }    
        }
        
        
        return redirect('/stores/' . $review->store_id);
    }
    
    public function destroy(Review $review, Store $store)
    {
        $images=$review->images()->get();
        
        if($images){
            foreach($images as $image){
                Storage::disk('s3')->delete($image['photo_path']);
                $image->delete();
            }
        }
        
        $review->delete();
        
        
        return redirect('/stores/' . $review->store_id);
    }
}
