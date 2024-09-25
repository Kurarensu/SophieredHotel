<?php

namespace App\Http\Controllers;

use App\Models\Guests;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guests::all();
        return view('guest.index', ['guest' => $guests]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guest.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:guests,email',
            'phone_number' => 'required|min:11',
            'address' => 'required',
        ]);

        Guests::create($request->all());
        return redirect('guests')->with('status','Guest Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return view('guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guests $guest)
    {
        return view('guest.edit',[
            'guest' => $guest
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guests $guest)
    {
        $guest = Guests::where('email', $request->email)->where('guest_id', $guest->guest_id)->first();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'password' => 'required|min:8',
            'phone_number' => 'required|min:11',
            'address' => 'required',
            'email' => 'required|email|unique:guests,email,' . $guest->guest_id
        ]);

        $guest->update($request->all());

        return redirect('guests')->with('status','Guest Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('guests.index')->with('success', 'Guest deleted successfully.');
    }
}
