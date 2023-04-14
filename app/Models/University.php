<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_type_id',
        'name_km',
        'name_en',
        'about_km',
        'about_en',
        'logo',
        'website',
        'email',
        'phone',
        'images',
    ];

    /**
     *
     * @return Attribute
     */
    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function universityType(): BelongsTo
    {
        return $this->belongsTo(UniversityType::class);
    }
}
