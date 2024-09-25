<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingfeedbackandratingController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::with(['booking', 'guest'])->get();
        return view('feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookings = Booking::all();
        $guests = Guest::all();
        return view('feedbacks.create', compact('bookings', 'guests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,booking_id',
            'guest_id' => 'required|exists:guests,guest_id',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'late_checkout' => 'nullable|boolean',
        ]);

        Feedback::create($request->all());
        return redirect()->route('feedbacks.index')->with('success', 'Feedback created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return view('feedbacks.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        $bookings = Booking::all();
        $guests = Guest::all();
        return view('feedbacks.edit', compact('feedback', 'bookings', 'guests'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,booking_id',
            'guest_id' => 'required|exists:guests,guest_id',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'late_checkout' => 'nullable|boolean',
        ]);

        $feedback->update($request->all());
        return redirect()->route('feedbacks.index')->with('success', 'Feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully.');
    }
}
