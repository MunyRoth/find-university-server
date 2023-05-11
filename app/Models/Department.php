<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'name_km',
        'name_en'
    ];

    public function majors(): HasMany
    {
        return $this->hasMany(Major::class);
    }
}
