<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'is_locked',
    ];

    protected function casts(): array
    {
        return [
            'body' => 'encrypted',
            'is_locked' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unlockAttempts(): HasMany
    {
        return $this->hasMany(NoteUnlockAttempt::class);
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeLocked($query)
    {
        return $query->where('is_locked', true);
    }

    public function scopeUnlocked($query)
    {
        return $query->where('is_locked', false);
    }
}
