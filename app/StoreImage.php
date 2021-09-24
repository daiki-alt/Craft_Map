<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreImage extends Model
{
    protected $fillable = [
        'store_id',
        'photo_path'
        ];
}
