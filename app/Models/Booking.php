<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'field_id',
        'booking_date',
        'start_time',
        'duration_hours',
        'total_price',
        'status',
        'payment_method',
        'paid_at',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'paid_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->booking_date->translatedFormat('l, d M Y');
    }

    public function getFormattedTimeAttribute()
    {
        return substr($this->start_time, 0, 5);
    }
}
