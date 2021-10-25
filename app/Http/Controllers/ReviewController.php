<?php

namespace App\Http\Controllers;



use App\Review;
use App\Store;
use App\Image;
use Storage;
use Illuminate\Support\Facades\Gate;
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
        
        $review->user_id = $request->user()->id;

        $review->fill($review_input)->save();
        
        $disk = Storage::disk('s3');
        $images = $request->file('photo');
        if($images){
            foreach ($images as $image){
                $path = $disk->putFile('review_images', $image, 'public');
            
                Image::create([
                    'photo_path' => $path,
                    'review_id' => $review->id
                ]);
            }    
        }
        
        return redirect('/stores/' . $store_id);
    }
    
    public function edit(Review $review, Store $store)
    {
        if(! Gate::allows('poster', $review)){
            abort(403);
        }
        
        //星の数を選択したときに、選択された数だけcheckedにする
        $checked=['', '', '', '', '', ''];
        $checked[$review->stars]='checked';
        
        $image=$review->images()->get();
        
    
        return view('review/edit')->with(['review' => $review, 'store' => $store, 'checked' => $checked, 'images' => $image]);
    }
    
    public function update(Request $request, Review $review, Store $store)
    {
        if(! Gate::allows('poster', $review)){
            abort(403);
        }
        
        $review_input = $request['review'];
        
        $review->fill($review_input)->save();
        
        //$images_newにformから送られてきた写真をfile()を用いて保存
        $images_new = $request->file('photo');
        
        if($request['images']){
            //$imagesにformから送られてきた写真を代入
            $images=$request['images'];
            foreach($images as $image){
                //foreachを使用して選択された画像を一枚ずつs3、データベースからそれぞれ削除
                Storage::disk('s3')->delete($image);
                Image::where('photo_path',$image)->delete();
            }
        }
        
        if($images_new){
            foreach ($images_new as $image) {
                //foreachを使用して画像一枚ずつs3に保存する
                $path = Storage::disk('s3')->putFile('review_images', $image, 'public');
            
                Image::create([
                    'photo_path' => $path,
                    'review_id' => $review->id
                ]);
            }    
        }
        
        return redirect('/stores/' . $review->store_id);
    }
    
    public function delete(Review $review, Store $store)
    {
        if(! Gate::allows('poster', $review)){
            abort(403);
        }
        
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
