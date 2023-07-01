<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HighSchoolSubject extends Model
{
    use HasFactory;

    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(MajorType::class, 'major_subject');
    }
}
