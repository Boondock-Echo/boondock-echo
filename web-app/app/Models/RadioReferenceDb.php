<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadioReferenceDb extends Model
{
    protected $table = 'radio_reference_db';

    protected $fillable = [
        'state',
        'county',
        'city',
        'zip',
        'frequency',
        'license',
        'type',
        'tone',
        'alpha_tag',
        'description',
        'mode',
        'tag',
        // Add more fields as needed
    ];
}