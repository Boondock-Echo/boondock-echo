<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorCodeManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text',
        'event_code',
        'event_description',
        'system',
    ];
}
