<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'mfa_secret',
        'balance_satoshis',
        'gross_profit',
        'net_profit',
        'games_played',
        'userclass',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'mfa_secret',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];



    // Relationships

    // A user has many plays
    public function plays()
    {
        return $this->hasMany(Play::class);
    }

    // A user has many fundings
    public function fundings()
    {
        return $this->hasMany(Funding::class);
    }

    // A user has many chat_messages
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    // A user has many giveaways
    public function giveaways()
    {
        return $this->hasMany(Giveaway::class);
    }

    // A user has many recovery tokens
    public function recoveryTokens()
    {
        return $this->hasMany(Recovery::class);
    }

    // A user has many sessions
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
