<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac', 'length', 'file_name', 'sent', 'station', 'frequency','transcribe_long','org_audio'
    ];

    public function dock()
    {
        return $this->belongsTo(Dock::class, 'mac', 'mac');
    }
    // public function dockpack()
    // {
    //     return $this->belongsTo(Dock::class, 'mac', 'mac');
    // }

    public function outbox()
   {
    return $this->hasMany(Outbox::class);
    }

    protected static function booted()
{
    static::created(function ($message) {
        if ($message->dock->auto_transcribe) {
            event(new \App\Events\MessageAdded($message));
        }
    });
}

}
