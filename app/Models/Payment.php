<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'user_id',
        'game_title',
        'item',
        'payment_method',
        'account_number',
        'total',
        'payment_proof',
        'status',
        'redeem_code',  // Jika ada kolom redeem_code
    ];

    

    // Relasi dengan User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Jika ada relasi dengan Inbox (sesuai model yang digunakan)
    public function inbox()
    {
        return $this->hasMany(Inbox::class);
    }
}
