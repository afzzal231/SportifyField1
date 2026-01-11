<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facility extends Model
{
    protected $fillable = [
        'field_id',
        'name',
        'icon',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}
