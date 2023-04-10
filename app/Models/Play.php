<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    use HasFactory;
    // Define the columns in the plays table
    protected $fillable = [
        'user_id',
        'cash_out',
        'auto_cash_out',
        'game_id',
        'bet',
        'bonus',
    ];

    // Relationships

    // A play belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A play belongs to a game
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
