<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class FieldController extends Controller
{
    public function index(Request $request)
    {
        $query = Field::with(['sport', 'images']);

        // Filter by sport
        if ($request->has('sport') && $request->sport !== 'all') {
            $query->whereHas('sport', function ($q) use ($request) {
                $q->where('slug', $request->sport);
            });
        }

        // Filter by city
        if ($request->has('city') && $request->city !== 'all') {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by price
        if ($request->has('price')) {
            switch ($request->price) {
                case 'low':
                    $query->where('price_per_hour', '<', 100000);
                    break;
                case 'medium':
                    $query->whereBetween('price_per_hour', [100000, 200000]);
                    break;
                case 'high':
                    $query->where('price_per_hour', '>', 200000);
                    break;
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        $fields = $query->get();
        $sports = Sport::all();

        return view('fields.index', compact('fields', 'sports'));
    }

    public function create()
    {
        $user = Auth::user();
        $sports = Sport::all();
        return view('fields.register', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sport_id' => 'required',
            'price_per_hour' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'map_embed_url' => 'nullable|string',
            'floor_type' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Create the field
        $field = Field::create([
            'user_id' => Auth::id(),
            'sport_id' => $request->sport_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'map_embed_url' => $request->map_embed_url,
            'price_per_hour' => $request->price_per_hour,
            'floor_type' => $request->floor_type,
            'changing_room' => $request->has('changing_room'),
            'bathroom' => $request->has('bathroom'),
            'parking' => $request->has('parking'),
            'rating' => 0,
            'is_available' => true,
        ]);

        // Save image to field_images table
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fields', 'public');

            \App\Models\FieldImage::create([
                'field_id' => $field->id,
                'image_path' => $imagePath,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('home')->with('success', 'Field berhasil didaftarkan!');

    }

    public function show($slug)
    {
        $field = Field::with(['sport', 'images', 'facilities', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('fields.show', compact('field'));
    }
}
