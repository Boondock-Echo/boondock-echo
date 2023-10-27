<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulerLog extends Model
{
    use HasFactory;

    protected $table = 'scheduler_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schedule_id',
        'job_id',
    ];

    /**
     * Get the schedule associated with the scheduler log.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
