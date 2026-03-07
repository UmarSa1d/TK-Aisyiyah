<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbField extends Model
{
    protected $fillable = ['name', 'type', 'required', 'urutan'];

    protected $casts = [
        'required' => 'boolean',
    ];
}