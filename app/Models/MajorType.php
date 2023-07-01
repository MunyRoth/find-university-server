<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MajorType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_km',
        'name_en',
        'image'
    ];

    public function majors(): HasMany
    {
        return $this->hasMany(Major::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(HighSchoolSubject::class, 'major_subject');
    }
}
