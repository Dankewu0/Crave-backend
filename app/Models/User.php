<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = ["name", "email", "password", "avatar", "tag"];

    protected $hidden = ["password", "remember_token"];

    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function privacySetting()
    {
        return $this->hasOne(PrivacySetting::class);
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }
}
