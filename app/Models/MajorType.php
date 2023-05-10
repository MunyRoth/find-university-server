<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_km',
        'name_en'
    ];
}
