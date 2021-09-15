<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'type',
        'work_type',
        'address',
        'telephone_number',
        'start_hours',
        'end_hours',
        'payment'
    ];
    
    public function crafts()
    {
        return $this->belongsToMany('App\Craft');
    }
    
    public function payments()
    {
        return $this->belongsToMany('App\Payment');
    }
    
    public function reviews() 
    { 
        return $this->hasMany(\App\Review::class, 'store_id', 'id');
    }
    
    public function users() {
        return $this->belongsToMany('App\User', 'likes');
    }
 
    
}
