<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',
        'year',
        'semester',
        'name_km',
        'name_en'
    ];

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }
}
