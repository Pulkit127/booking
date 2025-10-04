<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Models\Category;    

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all()->sortByDesc('id');   
        return view('admin.images.index',compact('images'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.images.create',compact('categories'));
    }

    public function store(ImageRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('url')) {
            $imagePath = $request->file('url')->store('images', 'public');
            $data['url'] = $imagePath;
        }
        Image::create($data);
        return redirect()->route('image.index')->with('success', 'Add image successfully!');
    }

    public function delete()
    {
        $id = request('id');
        $image = Image::find($id);
        unlink(public_path('storage/' . $image->url));
        $image->delete();
        return redirect()->route('image.index')->with('success', 'Delete image successfully');
    }
}
