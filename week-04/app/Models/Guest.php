<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'phone',
        'category',
        'qr_token',
        'checkin_status',
        'souvenir_status',
        'checkin_time',
    ];

    protected $casts = [
        'checkin_status'  => 'boolean',
        'souvenir_status' => 'boolean',
        'checkin_time'    => 'datetime',
    ];

    // Relasi: tamu milik satu event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Relasi: satu tamu punya satu RSVP
    public function rsvp(): HasOne
    {
        return $this->hasOne(Rsvp::class, 'guest_id');
    }

    // Relasi: satu tamu punya banyak scan log
    public function scanLogs(): HasMany
    {
        return $this->hasMany(ScanLog::class, 'guest_id');
    }
}
