<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission; // If using Spatie package for permission management

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Rooms::all();
        return view('room.index', ['room' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required',
            'room_type' => 'required',
            'price_per_night' => 'required|numeric',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max file size 2MB
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            // Get the file from the request
            $file = $request->file('image');
            
            // Extract only the filename
            $filename = time() . '-' . $file->getClientOriginalName();
            
            // Store the file in the 'public/images' directory
            $file->storeAs('images', $filename, 'public');

            // Optionally, return the path or store it in the database
            //return back()->with('success', 'Image uploaded successfully!')->with('image', $imagePath);

            
            Rooms::create([
                'room_number' => $request->room_number,
                'room_type' => $request->room_type,
                'price_per_night' => $request->price_per_night,
                'status' => $request->status,
                'image' => $filename
            ]);

            return redirect('rooms')->with('status','Room Created Successfully');
        }


        /* Rooms::create($request->all());
        return redirect('rooms')->with('status','Room Created Successfully'); */

    }

    /**
     * Display the specified resource.
     */
    public function show(Rooms $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rooms $room)
    {
        return view('room.edit',[
            'room' => $room
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rooms $room)
    {
        $request->validate([
            'room_number' => 'required',
            'room_type' => 'required',
            'price_per_night' => 'required|numeric',
            'status' => 'required',
            'image' => 'nullable|string',
        ]);

        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roomId)
    {
        $room = Rooms::findOrFail($roomId);
        $room->delete();
        return redirect('rooms')->with('status','Room deleted successfully.');
        
    }
}
