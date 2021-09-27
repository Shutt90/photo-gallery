<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

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

    public function update(int $id)
    {

        $rules = array([
            'title' => 'text|max:20',
            'category_id' => 'required',
        ]);

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $image = Gallery::find('id', $id);
            $image->title = Input::get('title');
            $image->category_id = Input::get('category_id');
        
            return back();
        }

    }

    public function destroy(int $id)
    {
        $image = Gallery::find('id', $id);
        $image->delete()->with('success', 'Image has been deleted');
    }

}
