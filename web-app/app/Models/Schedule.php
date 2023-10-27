<?php

namespace App\Models;

use App\Jobs\ScheduleJob;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Horizon\Contracts\JobRepository;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';
    protected $fillable = [
        'dock_id',
        'user_id',
        'type',
        'date',
        'day_of_month',
        'time',
        'week_day',
        'is_enabled',
        'task',
        'task_name',
        'description',
        'scheduled_datetime',
    ];

    public function dock()
    {
        return $this->belongsTo(Dock::class);
    }
    public function dispatchJob()
    {
        ScheduleJob::dispatch($this)->delay($this->scheduled_datetime);
    }
    public function deleteJob(JobRepository $jobRepository)
    {
        // Delete the corresponding job from the queue
        $jobId = $this->job_id;
        $jobRepository->delete($jobId);
    }
    public function scheduleLogs()
    {
        return $this->hasMany(SchedulerLog::class);
    }
}
