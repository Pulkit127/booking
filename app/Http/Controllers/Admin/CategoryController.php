<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all()->sortByDesc('id');
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        Category::create($data);
        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    public function delete()
    {
        $id = request('id');
        $user = Category::find($id);
        $user->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
