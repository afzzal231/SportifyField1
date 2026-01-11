<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenueRegistration extends Model
{
    protected $fillable = [
        'venue_name',
        'sport_type',
        'description',
        'price_per_hour',
        'owner_name',
        'owner_email',
        'owner_phone',
        'address',
        'city',
        'status',
    ];
}
