<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoteUnlockAttempt extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'note_id',
        'user_id',
        'successful',
        'ip_address',
        'attempted_at',
    ];

    protected function casts(): array
    {
        return [
            'successful'   => 'boolean',
            'attempted_at' => 'datetime',
        ];
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}