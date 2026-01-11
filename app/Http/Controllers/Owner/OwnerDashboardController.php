<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();

        // Get all bookings for fields owned by this user
        $bookingsQuery = Booking::whereHas('field', function ($q) use ($ownerId) {
            $q->where('user_id', $ownerId);
        });

        $totalBooking = $bookingsQuery->count();
        $confirmedBooking = (clone $bookingsQuery)->where('status', 'confirmed')->count();
        $pendingBooking = (clone $bookingsQuery)->where('status', 'pending')->count();
        $cancelledBooking = (clone $bookingsQuery)->where('status', 'cancelled')->count();

        $totalIncome = (clone $bookingsQuery)->where('status', 'confirmed')->sum('total_price');

        // Get recent bookings with relations for display
        $bookings = Booking::with(['user', 'field'])
            ->whereHas('field', function ($q) use ($ownerId) {
                $q->where('user_id', $ownerId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.dashboard', compact(
            'totalBooking',
            'confirmedBooking',
            'pendingBooking',
            'cancelledBooking',
            'totalIncome',
            'bookings'
        ));
    }

    public function confirm(Booking $booking)
    {
        // Verify ownership
        if ($booking->field->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking berhasil dikonfirmasi!');
    }

    public function reject(Booking $booking)
    {
        // Verify ownership
        if ($booking->field->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking berhasil ditolak.');
    }
}