<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class HighSchoolSubject extends Model
{
    use HasFactory;

    public function subjects(): MorphToMany
    {
        return $this->morphToMany(MajorType::class, 'majorSubject');
    }
}
