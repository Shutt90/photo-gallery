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
            ->with('Success', 'Image has successfully been uploaded');

        } elseif ($request->name) {
            
            $request->validate([
                'name' => 'required|max:20',
            ]);

            Category::create([
                'name' => $request->name
            ]);

            return back()
            ->with('Success', 'Category has successfully been added');
        };

    
    }

    public function update(Request $request, int $id)
    {

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

    public function destroy(int $id)
    {
        Gallery::find($id)->delete();

        return back()->with('success', 'Image deleted');
    }

}
