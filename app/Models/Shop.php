<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "city",
        "address",
        "phone",
        "work_time",
        "is_active",
    ];

    /**
     * Приведение типов: чтобы поле is_active всегда было булевым (true/false)
     */
    protected $casts = [
        "is_active" => "boolean",
    ];
}
