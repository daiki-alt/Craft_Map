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
        $abc=$store->crafts()->pluck('id');
        $check=[0,0,0,0,0];
        foreach($abc as $ab){
            $ab-=1;
            $check[$ab]=1;
            
        }
        
        $def=$store->payments()->pluck('id');
        $count=[0,0,0,0];
        foreach($def as $de){
            $de-=1;
            $count[$de]=1;
        }
        
        return view('edit')->with(['store' => $store , 'crafts' =>$craft->get(), 'payments' => $payment->get() , 'check' => $check , 'count' => $count]);
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
