<?php

namespace App\Http\Controllers;

use App\Craft;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index()
    {
        $crafts = Craft::all();

        return view('top')->with(['crafts' => $crafts]);
    }
}
