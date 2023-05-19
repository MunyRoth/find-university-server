<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UniversityBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'province_id',
        'address_km',
        'address_en',
        'location'
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
