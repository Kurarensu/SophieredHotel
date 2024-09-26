<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Guests;

class CustomerController extends Controller
{
    // Display all available rooms
    public function viewRooms()
    {
        // Fetch all available rooms
        $rooms = Room::where('status', 'available')->get();
        return view('customer.rooms', compact('rooms'));
    }

    // Display details for a single room
    public function showRoom($id)
    {
        $room = Room::findOrFail($id);
        return view('customer.showRoom', compact('room'));
    }

    // Book a room
    public function bookRoom(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        // Check if room is still available
        $room = Room::findOrFail($request->room_id);

        if ($room->status !== 'available') {
            return back()->with('error', 'This room is no longer available.');
        }

        // Create a booking
        Booking::create([
            'room_id' => $room->id,
            'user_id' => auth()->id(),
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'number_of_guests' => $request->guests,
            'total_price' => $room->price_per_night * ($request->check_out - $request->check_in),
        ]);

        // Mark room as booked
        $room->update(['status' => 'booked']);

        return redirect()->route('customer.rooms')->with('success', 'Room booked successfully.');
    }

    // Show customer profile
    public function profile()
    {
        $customer = auth()->user();
        return view('customer.profile', compact('customer'));
    }

    // Update customer profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|min:10',
            'address' => 'nullable|string|max:255',
        ]);

        // Update customer profile
        auth()->user()->update($request->all());

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
