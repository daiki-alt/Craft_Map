<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
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
}