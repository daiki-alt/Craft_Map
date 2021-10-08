<?php

namespace App\Http\Controllers;

use App\Craft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index()
    {
        $craft = Craft::all();

        return view('top')->with(['crafts' => $craft]);
    }
}
