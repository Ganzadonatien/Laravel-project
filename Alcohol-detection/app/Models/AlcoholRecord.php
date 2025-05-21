<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlcoholRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alcohol_level',
        'tested_at',
    ];

    protected $casts = [
        'tested_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
