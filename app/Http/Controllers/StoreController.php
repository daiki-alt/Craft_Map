<?php

namespace App\Http\Controllers;

use App\Store;
use App\Craft;
use App\Payment;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Store $store)
    {
        return view('index')->with(['stores' => $store->getPaginateByLimit()]);
    }
    
    public function show(Store $store , Craft $craft , Payment $payment)
    {
        return view('show')->with([
            'store' => $store , 
            'crafts' => $store->crafts()->get() , 
            'payments' => $store->payments()->get()
            ]);
    }
    
    public function create(Craft $craft, Payment $payment)
    {
        return view('create')->with(['crafts' =>$craft->get() , 'payments' => $payment->get()]);
    }
    
    public function store(Request $request, Store $store , Craft $craft , Payment $payment)
    {
        $store_input = $request['store'];
        $craft_input = $request['craft'];
        $payment_input = $request['payment'];
        
        $store->fill($store_input)->save();
        $store->crafts()->attach($craft_input);
        $store->payments()->attach($payment_input);
        
        return redirect('/stores/' . $store->id);
    }
    
    public function edit(Store $store , Craft $craft, Payment $payment)
    {
        $crafts=$craft->get();
        $payments=$payment->get();
        $selected_craft_ids=$store->crafts()->pluck('id');
        $selected_payment_ids=$store->payments()->pluck('id');
        
        foreach($crafts as $craft){
            $craft['is_selected']=false;
            
            foreach($selected_craft_ids as $selected_craft_id){
                if($craft->id==$selected_craft_id){
                    $craft['is_selected']=true;
                }
            }
        }
        
        foreach($payments as $payment){
            $payment['is_selected']=false;
            
            foreach($selected_payment_ids as $selected_payment_id){
                if($payment->id==$selected_payment_id){
                    $payment['is_selected']=true;
                }
            }
        }
    
        return view('edit')->with(['store' => $store , 'crafts' =>$crafts, 'payments' => $payments]);
    }
    
    public function update(Request $request, Store $store , Craft $craft , Payment $payment)
    {
        $store_input = $request['store'];
        $craft_input = $request['craft'];
        $payment_input = $request['payment'];
        
        $store->fill($store_input)->save();
        $store->crafts()->detach();
        $store->payments()->detach();
        $store->crafts()->attach($craft_input);
        $store->payments()->attach($payment_input);
    
        return redirect('/stores/' . $store->id);
    }
    
    public function delete(Store $store)
    {
        $store->crafts()->detach();
        $store->payments()->detach();
        
        $store->delete();
        return redirect('/');
    }
}
