<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'audio_array',
        'dock_id',
        'email_alert',
        'owner_id',
    ];

    public function dock()
    {
        return $this->belongsTo(Dock::class);
    }
}
