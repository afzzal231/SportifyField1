<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    protected $fillable = [
        'user_id',
        'sport_id',
        'name',
        'slug',
        'description',
        'address',
        'map_embed_url',
        'city',
        'province',
        'price_per_hour',
        'rating',
        'is_available',
        'floor_type',
        'changing_room',
        'bathroom',
        'parking',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'rating' => 'decimal:1',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(FieldImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(FieldImage::class)->where('is_primary', true);
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(Facility::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
