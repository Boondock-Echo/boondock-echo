<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dock()
    {
        return $this->belongsTo(Dock::class);
    }
    public function messageId()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }
    
    
}