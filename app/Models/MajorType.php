<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MajorType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_km',
        'name_en'
    ];

    public function majors(): HasMany
    {
        return $this->hasMany(Major::class);
    }
}
