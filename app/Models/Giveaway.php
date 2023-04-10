<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giveaway extends Model
{
    use HasFactory;
    // Define the columns in the giveaways table
    protected $fillable = [
        'amount',
        'user_id',
    ];

    // Relationships

    // A giveaway belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
