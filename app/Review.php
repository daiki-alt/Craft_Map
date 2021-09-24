<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'store_id',
        'user_id',
        'stars',
        'comment'
    ];
    
    public function user() 
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id')->select('id', 'name');
    }
    
    public function images() 
    { 
        return $this->hasMany(\App\Image::class, 'review_id', 'id');
    }
}