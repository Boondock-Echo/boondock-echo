<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $fillable = [
        'station',
        'category_id',
        'frequency',
        'rx_enabled',
        'user_id',
        'tx_enabled',
        'description'
    ];
}
