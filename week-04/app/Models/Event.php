<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'groom_name',
        'bride_name',
        'event_date',
        'location_name',
        'location_maps_url',
        'theme',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    // Relasi: event dimiliki oleh satu user (organizer)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: satu event punya banyak scanner
    public function eventScanners(): HasMany
    {
        return $this->hasMany(EventScanner::class, 'event_id');
    }

    // Relasi: satu event punya banyak tamu (guests)
    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class, 'event_id');
    }

    // Relasi: satu event punya banyak entri guestbook
    public function guestbooks(): HasMany
    {
        return $this->hasMany(Guestbook::class, 'event_id');
    }
}
