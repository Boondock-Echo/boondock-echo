<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'mac', 'length', 'file_name', 'sent', 'station', 'frequency','transcribe_long','description'
    ];

    public function dock()
    {
        return $this->belongsTo(Dock::class, 'mac', 'mac');
    }
    // public function dockpack()
    // {
    //     return $this->belongsTo(Dock::class, 'mac', 'mac');
    // }
}