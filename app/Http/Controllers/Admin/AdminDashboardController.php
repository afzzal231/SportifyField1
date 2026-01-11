<?php

namespace App\Http\Controllers\Admin;

use App\Models\Field;
use App\Models\Booking;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $fieldCount = Field::count();
        $bookingCount = Booking::count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');
        $pendingCount = Booking::where('status', 'pending')->count();
        $confirmedCount = Booking::where('status', 'confirmed')->count();

        // Get all bookings with user and field info
        $allBookings = Booking::with(['user', 'field'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'fieldCount',
            'bookingCount',
            'totalRevenue',
            'pendingCount',
            'confirmedCount',
            'allBookings'
        ));
    }


}
