<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameHash extends Model
{
    use HasFactory;
    // Define the columns in the game_hashes table
    protected $fillable = [
        'game_id',
        'hash',
    ];

    // Set primary key to a non-incrementing field
    public $incrementing = false;
    protected $keyType = 'string';

    // Relationships

    // A game hash belongs to a game
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
