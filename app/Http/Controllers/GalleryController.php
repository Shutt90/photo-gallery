<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;

class GalleryController extends Controller
{

    public function index()
    {

        $gallery = Gallery::with('categoryRelation')->orderBy('id', 'desc')->get();
        $category = Category::with('galleryRelation')->orderBy('id', 'asc')->get();

        return view('front.view', [
            'gallery' => $gallery,
            'category' => $category,
        ]);
        
    }

}
