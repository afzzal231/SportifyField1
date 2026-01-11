<?php

namespace App\Http\Controllers;

use App\Models\VenueRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenueRegistrationController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('venue.register', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'venue_name' => 'required|string|max:255',
            'sport_type' => 'required|string',
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email',
            'owner_phone' => 'required|string',
        ]);

        VenueRegistration::create([
            'venue_name' => $request->venue_name,
            'sport_type' => $request->sport_type,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'owner_name' => $request->owner_name,
            'owner_email' => $request->owner_email,
            'owner_phone' => $request->owner_phone,
            'address' => $request->address,
            'city' => $request->city,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Pendaftaran venue berhasil! Tim kami akan menghubungi Anda dalam 1-2 hari kerja.');
    }
}
