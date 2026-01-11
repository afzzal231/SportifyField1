<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($fieldId)
    {
        $field = Field::with(['sport', 'images'])->findOrFail($fieldId);

        return view('booking.create', compact('field'));
    }

    public function store(Request $request, $fieldId)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'duration_hours' => 'required|integer|min:1|max:4',
        ]);

        $field = Field::findOrFail($fieldId);

        $totalPrice = $field->price_per_hour * $request->duration_hours;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $fieldId,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'duration_hours' => $request->duration_hours,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.index', $booking->id);
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);

        return view('booking.show', compact('booking'));
    }
}
