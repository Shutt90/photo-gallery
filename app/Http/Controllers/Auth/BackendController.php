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
        $category = Category::orderBy('id', 'desc')->get();

        $catArr = [];

        foreach($category as $item => $value){
            array_push($catArr, $value->galleryRelation->pluck('file_path'));
        };

        return view('admin.view', [
            'gallery' => $gallery,
            'category' => $category,
            'catArr' =>$catArr,
        ]);
        
    }

    public function store(Request $request)
    {

        if($request->file('file_path')) {

            $request->validate([
                'title' => 'required|string|max:20',
                'file_path' => 'required|mimes:jpg,png,jpeg',
                'category_id' => 'required|integer',
            ]);

            $fileModel = new Gallery;
            $fileName = time() . '_' . $request->file_path->getClientOriginalName();
            $filePath = $request->file('file_path')->storeAs('images', $fileName, 'public');
            $fileModel->title = $request->title;
            $fileModel->file_path = $filePath;
            $fileModel->category_id = $request->category_id;
            $fileModel->save();

            return back()
            ->with('success', 'Image has successfully been uploaded');

        } elseif ($request->name) {

            $request->validate([
                'name' => 'required|max:20',
            ]);

            Category::create([
                'name' => $request->name
            ]);

            return back()
            ->with('success', 'Category has successfully been added');
        };

    
    }

    public function update(Request $request, int $id)
    {

        if($request->title || $request->category_id){

            $validated = $request->validate([
                'title' => 'max:20',
                'category_id' => 'integer',
            ]);

            if($validated) {
                Gallery::findOrFail($id)
                ->update([
                    'title' => $request->title,
                    'category_id' => $request->category_id,
                ]);
            
                return back()->with('success', "Image has been updated");
            }
        }

    }

    public function destroy(Request $request, int $id)
    {   

        if($request->input(['deleteimage'])) {
            Gallery::find($id)->delete();
            return redirect()->route('admin.index')->with('error', 'Image deleted');
        }

        if($request->input(['deletecat'])) {
            Category::find($id)->delete();
            return redirect()->route('admin.index')->with('error', 'Category deleted');
        }
    }

}
