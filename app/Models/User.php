<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Suscription;

/**
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property bool $active
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TABLE_NAME = 'users';
    const COLUMN_NAME = 'name';
    const COLUMN_USERNAME = 'username';
    const COLUMN_EMAIL = 'email';
    const COLUMN_PASSWORD = 'password';
    const COLUMN_ACTIVE = 'active';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_USERNAME,
        self::COLUMN_EMAIL,
        self::COLUMN_PASSWORD,
        self::COLUMN_ACTIVE,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function suscriptions()
    {
        return $this->belongsToMany(Suscription::class, 'users_suscriptions');
    }

}