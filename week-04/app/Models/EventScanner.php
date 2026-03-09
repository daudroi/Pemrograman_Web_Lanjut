<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventScanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
    ];

    // Relasi: event scanner milik satu event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Relasi: event scanner milik satu user (scanner)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
