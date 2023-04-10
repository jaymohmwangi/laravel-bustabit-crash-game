<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    // Define the columns in the sessions table
    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'ott',
        'created_at',
        'expired',
    ];

    // Set primary key to a non-incrementing field
    public $incrementing = false;
    protected $keyType = 'string';

    // Relationships

    // A session belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
