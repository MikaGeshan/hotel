<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Kamar;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reservations = Reservation::with('customer', 'room')->get();

        return Inertia::render('Admin/Reservations/ReservationList', [
            'reservations' => $reservations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Kamar::all();
        $customers = Customer::all();

        return Inertia::render('Admin/Reservations/CreateReservation', [
            'rooms' => $rooms,
            'customers' => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservation_code' => 'required|string|unique:reservations,reservation_code',
            'customer_id' => 'required|exists:customers,id',
            'room_id' => 'required|exists:kamars,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'total_price' => 'required|integer|min:0',
            'payment_status' => 'required|in:Paid,Pending,Cancelled',
        ]);

        $reservation = Reservation::create([
            'reservation_code' => $request->reservation_code,
            'customer_id' => $request->customer_id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'total_price' => $request->total_price,
            'payment_status' => $request->payment_status,
        ]);

        Kamar::where('id', $request->room_id)->update(['status' => 'Booked']);

        return redirect()->route('admin.reservations.list')->with('success', 'Reservation created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
