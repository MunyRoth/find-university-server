<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',
        'price_usd'
    ];
}
