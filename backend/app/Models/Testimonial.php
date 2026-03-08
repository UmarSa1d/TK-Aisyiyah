<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'nama',
        'kelas',
        'teks',
        'bintang',
        'baru'
    ];
}