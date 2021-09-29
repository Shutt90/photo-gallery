<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Category;

class GalleryController extends Controller
{

    public function index()
    {

        $gallery = Gallery::with('categoryRelation')->orderBy('id', 'desc')->get();
        $category = Category::with('galleryRelation')->orderBy('id', 'asc')->get();

        $catArr = [];

        foreach($category as $item => $value){
            array_push($catArr, $value->galleryRelation->pluck('file_path'));
        };

        return view('front.view', [
            'gallery' => $gallery,
            'category' => $category,
            'catOne' => $catArr[0],
            'catTwo' => $catArr[1],
            'catThree' => $catArr[2],
            'catFour' => $catArr[3],
            'catFive' => $catArr[4],
        ]);
        
    }

}
