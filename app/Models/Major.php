<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'major_type_id',
        'name_km',
        'name_en'
    ];

    public function majorType(): BelongsTo
    {
        return $this->belongsTo(MajorType::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
