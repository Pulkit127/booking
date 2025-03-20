<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
use App\Models\RoomImage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    public function store(RoomRequest $request)
    {
        $data = $request->validated();
        $room = Room::create($data);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('rooms', 'public'); // Store each image
                // Save Image Path in Room Images Table
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $imagePath
                ]);
            }
        }
        return redirect()->route('room.index')->with('success', 'Room created successfully');
    }

    public function show()
    {
        $id = request('id');
        $room = Room::with('images')->findOrFail($id); // Fetch room with images
        return view('admin.rooms.show', compact('room'));
    }

    public function edit()
    {
        $id = request('id');
        $room = Room::findOrFail($id);
        $roomTypes = RoomType::all();
        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(RoomRequest $request, $room_id)    
    {
        $room = Room::findOrFail($room_id);
        $data = $request->validated();
        $room->update($data);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('rooms', 'public'); // Store each image
                // Save Image Path in Room Images Table
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $imagePath
                ]);
            }
        }
        return redirect()->route('room.index')->with('success', 'Room updated successfully');
    }   

    public function deleteImage()
    {
        $image_id = request('image_id');
        $roomImage = RoomImage::findOrFail($image_id);
        unlink(public_path('storage/' . $roomImage->image_path));
        $roomImage->delete();
        return response()->json(['success' => 'Image deleted successfully']);
    }   

    public function destroy()
    {
        $id = request('id');
        $rooms = Room::find($id);
        unlink(public_path('storage/' . $rooms->image));
        $rooms->delete();
        return redirect()->route('room.index')->with('success', 'Room deleted successfully');
    }
}
