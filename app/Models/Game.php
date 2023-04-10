<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    // Define the columns in the games table
    protected $fillable = [
        'game_crash',
        'ended',
    ];

    // Relationships

    // A game has many plays
    public function plays()
    {
        return $this->hasMany(Play::class);
    }
}
