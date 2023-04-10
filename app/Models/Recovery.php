<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recovery extends Model
{
    use HasFactory;
    // Define the columns in the recovery table
    protected $fillable = [
        'id',
        'user_id',
        'ip',
        'created_at',
        'expired',
        'used',
    ];

    // Set primary key to a non-incrementing field
    public $incrementing = false;
    protected $keyType = 'string';

    // Relationships

    // A recovery token belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
