<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'name', 'account_number'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

