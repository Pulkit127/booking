<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use App\Http\Requests\VideoRequest; 

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all()->sortByDesc('id');   
        return view('admin.videos.index',compact('videos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.videos.create',compact('categories'));
    }

    public function store(VideoRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('url')) {
            $videoPath = $request->file('url')->store('videos', 'public');
            $data['url'] = $videoPath;
        }
        Video::create($data);
        return redirect()->route('video.index')->with('success', 'Add video successfully!');
    }

    public function delete()
    {
        $id = request('id');
        $video = Video::find($id);
        unlink(public_path('storage/' . $video->url));
        $video->delete();
        return redirect()->route('video.index')->with('success', 'Delete video successfully');
    }
}
