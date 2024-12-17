<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    // Menambahkan kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'title',        // Menambahkan title ke dalam fillable
        'slug',         // Pastikan slug ada di sini jika menggunakan mass assignment
        'image_path',   // Jika menggunakan gambar
        'link',         // Jika ada field link
    ];
}
