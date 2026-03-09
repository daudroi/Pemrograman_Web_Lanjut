<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rsvp extends Model
{
    use HasFactory;

    protected $table = 'rsvps';

    protected $fillable = [
        'guest_id',
        'attendance_status',
        'total_person',
        'message',
    ];

    // Relasi: RSVP milik satu tamu
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }
}
