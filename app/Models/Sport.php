<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sport extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
