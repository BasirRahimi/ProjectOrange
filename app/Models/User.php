<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Client;
use App\Models\Reminder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Roles: 
     * 1 - superadmin
     * 2 - admin
     * 3 - ifa
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    /**
     * Get the user role
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class);
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return '447467423199';
    }

    /**
     * Get the Cases belonging to the user
     */
    public function cases($case_type_id = null): HasMany
    {
        if ($case_type_id) {
            return $this->hasMany(POCase::class)->where('case_type_id', '=', $case_type_id);
        } else {
            return $this->hasMany(POCase::class);
        }
    }


    /**
     * TODO: Remove clients() function
     * Get the Clients belonging to the user
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Get reminders for this user
     */
    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }
}
