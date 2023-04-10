<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    // Define the columns in the chat_messages table
    protected $fillable = [
        'user_id',
        'message',
        'created_at',
        'is_bot',
        'channel',
    ];

    // Relationships

    // A chat message belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
