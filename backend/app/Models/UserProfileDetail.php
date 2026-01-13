<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfileDetail extends Model
{
    /** @use HasFactory<\Database\Factories\UserProfileDetailFactory> */
    use HasFactory;

    // Mass Assignment対策
    protected $guarded = ['id'];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
