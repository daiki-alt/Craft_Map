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
        'payment',
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
    
    public function user() {
        return $this->belongsTo('App\User');
    }
 
    public function likes() {
        return $this->hasMany('App\Like');
    }
    
    public function getByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
