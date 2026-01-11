<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Field;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sports = Sport::all();
        $fields = Field::with(['sport', 'images'])->take(6)->get();

        return view('home', compact('sports', 'fields'));
    }
}
