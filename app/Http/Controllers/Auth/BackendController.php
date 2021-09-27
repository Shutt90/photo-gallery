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
        $request->validate([
            'file' => 'mimes:jpg,png,jpeg'
        ]);

        $fileModel = new Gallery;

        if($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('images', $fileName, 'public');
            $fileModel->name = time() . '_' . $request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' .  $filePath;
            $fileModel->save();

            return back()
            ->with('Success', 'Image has successfully been uploaded')
            ->with('file', $fileName);
        };
    }

    public function update(Request $request, int $id)
    {

        $validated = $request->validate([
            'title' => 'max:20',
        ]);

        if($validated) {
            Gallery::findOrFail($id)
            ->update([
                'title' => $request->title,
            ]);
        
            return back()->with('success', "Image has been updated");
        }

        if($validated && $request->category_id) {
            Category::where('id', $request->category_id)
            ->update([
                'category_id' => $request->category_id,
            ]);

            return back();
        }

    }

    public function destroy(int $id)
    {
        $image = Gallery::find('id', $id);
        $image->delete()->with('success', 'Image has been deleted');
    }

}
