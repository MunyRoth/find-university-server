<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_type_id',
        'name_km',
        'name_en',
        'about_km',
        'about_en',
        'website',
        'email',
        'phone',
    ];

    public function universityType(): BelongsTo
    {
        return $this->belongsTo(UniversityType::class);
    }
}
