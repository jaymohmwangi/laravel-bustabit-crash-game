<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    use HasFactory;
    // Define the columns in the fundings table
    protected $fillable = [
        'user_id',
        'amount',
        'bitcoin_withdrawal_txid',
        'bitcoin_withdrawal_address',
        'description',
        'bitcoin_deposit_txid',
        'withdrawal_id',
    ];

    // Relationships

    // A funding belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
