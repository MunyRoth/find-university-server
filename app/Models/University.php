<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function universityBranches(): HasMany
    {
        return $this->hasMany(UniversityBranch::class);
    }

    public function faculties(): HasMany
    {
        return $this->hasMany(faculty::class);
    }

    // this is a recommended way to declare event handlers
    protected static function booted () {
        static::deleting(function(University $university) { // before delete() method call this
             $university->universityBranches()->delete();
             $university->faculties()->delete();
             // do the rest of the cleanup...
        });
    }
}
