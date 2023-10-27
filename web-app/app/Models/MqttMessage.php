<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MqttMessage extends Model
{
    use HasFactory;
   
    protected $table = 'mqtt_messages';
    protected $fillable = [
        'topic',
        'payload',
    ];
}
