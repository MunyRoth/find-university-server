<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityImage extends Model
{
    protected $fillable = [
        'university_id',
        'image'
    ];

    use HasFactory;
}
