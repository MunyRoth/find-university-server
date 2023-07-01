<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_type_id',
        'high_school_subject_id',
        'is_needed'
    ];
}
