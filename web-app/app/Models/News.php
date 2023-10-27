<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', // Add 'title' here to allow mass assignment for the title field.
        'description',
        'body',
        'hero_image',
        'card_image',
        'author_id',
    ];


    public function author()
{
    return $this->belongsTo(User::class);
}

}
