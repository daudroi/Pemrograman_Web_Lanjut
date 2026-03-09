<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: satu user bisa punya banyak event (sebagai organizer)
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    // Relasi: satu user bisa menjadi scanner di banyak event
    public function eventScanners(): HasMany
    {
        return $this->hasMany(EventScanner::class, 'user_id');
    }

    // Relasi: satu user (scanner) bisa punya banyak scan log
    public function scanLogs(): HasMany
    {
        return $this->hasMany(ScanLog::class, 'scanner_id');
    }
}
