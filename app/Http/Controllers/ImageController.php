<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ImageController extends Controller
{
    public function add()
    {
        return view('image/create');
    }
    
    public function create(Request $request)
    {
        $image = new Image;
        $form = $request->all();
    
        //s3アップロード開始
        $photo = $request->file('photo');
        // バケットの`myprefix`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('review_images', $photo, 'public');
        // アップロードした画像のフルパスを取得
        $image->photo_path = Storage::disk('s3')->url($path);
    
        $image->save();
    
        return redirect('image/create');
    }
}
