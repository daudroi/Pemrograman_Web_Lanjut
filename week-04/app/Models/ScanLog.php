<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScanLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'guest_id',
        'scanner_id',
        'scan_type',
        'scanned_at',
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    // Relasi: scan log milik satu tamu
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    // Relasi: scan log dilakukan oleh satu user (scanner)
    public function scanner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'scanner_id');
    }
}
