<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devicecodes extends Model
{
    protected $table = 'device_codes';
    use HasFactory;
    protected $fillable = [
        'code','status',
    ];

    public function dock()
    {
        return $this->belongsTo(Dock::class, 'dock_id');
    }
    public function bindwithdock()
    {
        return $this->belongsTo(Dock::class, 'dock_id','id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
