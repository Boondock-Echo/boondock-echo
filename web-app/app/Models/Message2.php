<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message2 extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $connection = 'mysql2';
    protected $fillable = [
        'mac', 'length', 'file_name', 'sent', 'station', 'frequency'
    ];

    public function dock()
    {
        return $this->belongsTo(Dock::class, 'mac', 'mac');
    }
}
