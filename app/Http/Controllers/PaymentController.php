<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index($bookingId)
    {
        $booking = Booking::with(['field.sport', 'field.images', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($bookingId);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $booking->id . '-' . time(), // Unique order ID
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
                'phone' => $booking->user->phone,
            ],
            'item_details' => [
                [
                    'id' => $booking->field->id,
                    'price' => $booking->field->price_per_hour,
                    'quantity' => $booking->duration_hours,
                    'name' => $booking->field->name . ' (' . $booking->booking_date->format('d M Y') . ' ' . $booking->start_time . ')',
                ]
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('payment.index', compact('booking', 'snapToken'));
    }

    public function process(Request $request, $bookingId)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::where('user_id', Auth::id())->findOrFail($bookingId);

        $booking->update([
            'payment_method' => $request->payment_method,
            'status' => 'confirmed',
            'paid_at' => now(),
        ]);

        return redirect()->route('payment.confirmation', $booking->id);
    }

    public function confirmation($bookingId)
    {
        $booking = Booking::with(['field.sport', 'field.images', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($bookingId);

        return view('payment.confirmation', compact('booking'));
    }
}
