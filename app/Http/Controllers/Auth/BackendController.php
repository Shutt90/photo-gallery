<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index()
    {

        $gallery = Gallery::with('categoryRelation')->orderBy('id', 'desc')->get();
        $category = Category::orderBy('id', 'asc')->get();

        return view('admin.view', compact('gallery','category'));
        
    }
}
