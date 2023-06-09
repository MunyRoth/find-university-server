<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_km',
        'type_en'
    ];
}
