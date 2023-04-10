<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

// Disable the incrementing feature on the primary key
    public $incrementing = false;

    // Define the columns in the blocks table
    protected $fillable = [
        'height',
        'hash',
    ];

    // Disable timestamps
    public $timestamps = false;
}
