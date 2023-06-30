<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'rate'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }
}
