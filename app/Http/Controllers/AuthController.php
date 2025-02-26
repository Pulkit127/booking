<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Video;

class AuthController extends Controller
{
    // User Registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json(['token' => $token, 'user' => $user], 201);
    }

    // User Login
    public function login(Request $request)
    {
        // Validate request input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
    
        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = Auth::guard('api')->user();
        $token = $user->createToken('Personal Access Token')->accessToken;
    
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    // Logout
    public function logout()
    {
        $user = Auth::guard('api')->user()->token()->revoke(); 
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getUser() {
        return response()->json(['user' => Auth::guard('api')->user()]);
    }

    /**
     * Add a new category
     */
    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Category added successfully', 'category' => $category], 201);
    }

    /**
     * Get all categories
     */
    public function getCategory()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories], 200);
    }

    /**
     * Delete a category
     */
    public function deleteCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
        ]);

        $category = Category::find($request->id);

        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully'], 200);
        }

        return response()->json(['message' => 'Category not found'], 404);
    }

    /**
     * Upload and store a video file
     */
    public function addVideo(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|file|mimes:mp4,mov,avi,mkv', // Max 50MB
            'category_id' => 'required',
        ]);

        // Store video in 'public/videos' folder
        $videoPath = $request->file('url')->store('videos', 'public');

        // Save video details to the database
        $video = Video::create([
            'category_id' => $request->category_id, 
            'title' => $request->title,
            'url' => asset('storage/' . $videoPath),
        ]);

        return response()->json(['message' => 'Video uploaded successfully', 'video' => $video], 201);
    }

    /**
     * Get all uploaded videos
     */
    public function getVideos()
    {
        $videos = Video::all();
        return response()->json(['videos' => $videos], 200);
    }

    /**
     * Delete a video
     */
    public function deleteVideo(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:videos,id',
        ]);

        $video = Video::find($request->id);

        if ($video) {
            // Delete video file from storage
            $videoPath = str_replace(asset('storage/'), '', $video->video_url);
            Storage::disk('public')->delete($videoPath);

            // Delete record from database
            $video->delete();

            return response()->json(['message' => 'Video deleted successfully'], 200);
        }

        return response()->json(['message' => 'Video not found'], 404);
    }
}
