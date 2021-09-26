<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{

    public function index()
    {

        $gallery = Gallery::orderBy('id', 'desc')->get();

        return view('front.view');
        
    }
}
