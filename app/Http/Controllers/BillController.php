<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Booking;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('booking')->get();
        return view('bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookings = Booking::all();
        return view('bills.create', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,booking_id',
            'room_charge' => 'required|numeric',
            'service_charge' => 'nullable|numeric',
            'misc_charge' => 'nullable|numeric',
            'late_checkout' => 'nullable|boolean',
            'amount_due' => 'required|numeric',
            'amount_paid' => 'nullable|numeric',
            'status' => 'required|string',
            'due_date' => 'required|date',
            'payment_date' => 'nullable|date',
            'mode' => 'nullable|string',
        ]);

        Bill::create($request->all());
        return redirect()->route('bills.index')->with('success', 'Bill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        return view('bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        $bookings = Booking::all();
        return view('bills.edit', compact('bill', 'bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,booking_id',
            'room_charge' => 'required|numeric',
            'service_charge' => 'nullable|numeric',
            'misc_charge' => 'nullable|numeric',
            'late_checkout' => 'nullable|boolean',
            'amount_due' => 'required|numeric',
            'amount_paid' => 'nullable|numeric',
            'status' => 'required|string',
            'due_date' => 'required|date',
            'payment_date' => 'nullable|date',
            'mode' => 'nullable|string',
        ]);

        $bill->update($request->all());
        return redirect()->route('bills.index')->with('success', 'Bill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }
}
