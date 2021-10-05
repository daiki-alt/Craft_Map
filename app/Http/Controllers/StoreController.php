<?php

namespace App\Http\Controllers;

use App\Store;
use App\Craft;
use App\Payment;
use App\Review;
use App\Image;
use App\StoreImage;
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Store $store, Craft $craft)
    {
        $store = Store::all();
        // $craft = Craft::all();
        
        return view('store/index')->with(['stores' => $store, 'crafts' => $craft]);
    }
    
    public function indexByCraft(Craft $craft)
    {
        $stores = $craft->stores()->get();
        
        return view('store/index')->with(['stores' => $stores, 'crafts' => $craft]);
    }
    
    public function show(Store $store, Craft $craft, Payment $payment, Review $review)
    {
        $self_review = $review->where('store_id', $store->id)->where('user_id', Auth::id())->first();
        $nonself_reviews = $review->where('store_id', $store->id)->where('user_id', '!=', Auth::id())->get();

        $user=Auth::user();
        
        return view('store/show')->with([
            'store' => $store, 
            'crafts' => $store->crafts()->get(), 
            'payments' => $store->payments()->get(),
            'self_review' => $self_review,
            'nonself_reviews' => $nonself_reviews,
            'user' => $user
            ]);
    }
    
    public function create(Craft $craft, Payment $payment)
    {
        return view('store/create')->with(['crafts' => $craft->get(), 'payments' => $payment->get()]);
    }
    
    public function store(Request $request, Store $store, Craft $craft, Payment $payment)
    {
        $store_input = $request['store'];
        $craft_input = $request['craft'];
        $payment_input = $request['payment'];
        
        $store->fill($store_input)->save();
        $store->crafts()->attach($craft_input);
        $store->payments()->attach($payment_input);
        
        $disk = Storage::disk('s3');
        $store_images = $request->file('store_photo');
        if($store_images){
            foreach ($store_images as $image) {
            $path = $disk->putFile('store_images', $image, 'public');
            
            StoreImage::create([
                    'photo_path' => $path,
                    'store_id' => $store->id,
                ]);
            }    
        }
        
        return redirect('/stores/' . $store->id);
    }
    
    public function edit(Store $store, Craft $craft, Payment $payment)
    {
        $crafts = $craft->get();
        $payments = $payment->get();
        $selected_craft_ids = $store->crafts()->pluck('id');
        $selected_payment_ids = $store->payments()->pluck('id');
        
        $store_image=$store->store_images()->get();
        
        foreach($crafts as $craft){
            $craft['is_selected'] = false;
            
            foreach($selected_craft_ids as $selected_craft_id){
                if($craft->id == $selected_craft_id){
                    $craft['is_selected'] = true;
                }
            }
        }
        
        foreach($payments as $payment){
            $payment['is_selected'] = false;
            
            foreach($selected_payment_ids as $selected_payment_id){
                if($payment->id == $selected_payment_id){
                    $payment['is_selected'] = true;
                }
            }
        }
    
        return view('store/edit')->with(['store' => $store, 'crafts' => $crafts, 'payments' => $payments, 'images' => $store_image]);
    }
    
    public function update(Request $request, Store $store, Craft $craft, Payment $payment)
    {
        $store_input = $request['store'];
        $craft_input = $request['craft'];
        $payment_input = $request['payment'];
        
        $store->fill($store_input)->save();
        $store->crafts()->detach();
        $store->payments()->detach();
        $store->crafts()->attach($craft_input);
        $store->payments()->attach($payment_input);
        
        if($request['store_images']){
            $store_images=$request['store_images'];
            foreach($store_images as $image){
                Storage::disk('s3')->delete($image);
                StoreImage::where('photo_path',$image)->delete();
            }
        }
        
        $disk = Storage::disk('s3');
        $store_images_new = $request->file('store_photo');
        if($store_images_new){
            foreach ($store_images_new as $image) {
            $path = $disk->putFile('store_images', $image, 'public');
            
            StoreImage::create([
                    'photo_path' => $path,
                    'store_id' => $store->id,
                ]);
            }    
        }
    
        return redirect('/stores/' . $store->id);
    }
    
    public function delete(Store $store)
    {
        $store->crafts()->detach();
        $store->payments()->detach();
        
        $store_image=$store->store_images()->get();
        
        if($store_image){
            foreach($store_image as $image){
                Storage::disk('s3')->delete($image['photo_path']);
                $image->delete();
            }
        }
        
        $store->delete();
        return redirect('/');
    }
    
    public function mapshow($name, Craft $craft, Payment $payment, Review $review)
    {
        $store=Store::where('name', $name)->first();
        
        $self_review = $review->where('store_id', $store->id)->where('user_id', Auth::id())->first();
        $nonself_reviews = $review->where('store_id', $store->id)->where('user_id', '!=', Auth::id())->get();

        $user=Auth::user();
        
        return view('store/show')->with([
            'store' => $store, 
            'crafts' => $store->crafts()->get(), 
            'payments' => $store->payments()->get(),
            'self_review' => $self_review,
            'nonself_reviews' => $nonself_reviews,
            'user' => $user
            ]);
    }
}
