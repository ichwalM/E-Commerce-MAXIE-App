<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorProfile extends Model
{
    /** @use HasFactory<\Database\Factories\DistributorProfileFactory> */
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'social_media' => 'array',
        'birth_date' => 'date',
    ];
}
