<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conversation extends Model
{
    protected $fillable = [
        "user_id",
        "support_id",
        "status",
        "last_message_at",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function support(): BelongsTo
    {
        return $this->belongsTo(User::class, "support_id");
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
