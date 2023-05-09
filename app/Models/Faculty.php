<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'name_km',
        'name_en',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }
}
