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
            'title' => 'required|string|max:20',
            'file_path' => 'required|mimes:jpg,png,jpeg',
            'category_id' => 'required|integer',
        ]);

        Gallery::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'file_path' => $request->file_path,
        ]);

        $fileModel = $request->file_path;

        if($request->file()) {
            $fileName = time() . '_' . $request->file_path->getClientOriginalName();
            $filePath = $request->file('file_path')->storeAs('images', $fileName, 'public');
            $fileModel->file_path = time() . '_' . $request->file_path->getClientOriginalName();
            $fileModel->pathname = '/storage/app/public/images/' .  $filePath;

            dd($fileModel);

            return back()
            ->with('Success', 'Image has successfully been uploaded')
            ->with('file', $fileName);
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
