<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_title',
        'item',
        'payment_method',
        'account_number',
        'total',
        'payment_proof',
        'status',
    ];


}


