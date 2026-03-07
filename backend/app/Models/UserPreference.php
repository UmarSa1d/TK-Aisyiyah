<?php

// File: app/Models/UserPreference.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'dark_mode',
        'color_theme',
        'system_mode',
    ];

    protected $casts = [
        'dark_mode'   => 'boolean',
        'system_mode' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}