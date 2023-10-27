<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explore extends Model
 
    {
        protected $table = 'explore';
    
        protected $fillable = [
            'Output_Freq',
            'Input_Freq',
            'Offset',
            'Uplink_Tone',
            'Downlink_Tone',
            'Location',
            'County',
            'Lat',
            'Long',
            'Call',
            'Use',
            'Op_Status',
            'Mode',
            'Digital_Access',
            'EchoLink',
            'IRLP',
            'AllStar',
            'Coverage',
            'Status',
            'Last_Update',
        ];
    
        protected $dates = ['Last_Update'];
    
        // Additional model methods or relationships can be defined here.
    }