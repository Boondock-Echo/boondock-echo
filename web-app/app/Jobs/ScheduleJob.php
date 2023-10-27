<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MQTT;
use App\Models\Dock;
use App\Models\Schedule;
use App\Models\SchedulerLog;
use App\Jobs\ScheduleJob;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;


class ScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public $schedule;
    protected $message;
    protected $jobTask;
    
    /**
     * Create a new job instance.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    public function __construct(Schedule $schedule, $message, $jobTask)
    {
        $this->schedule = $schedule;
        $this->message = $message; // Store the message as a property
        $this->jobTask = $jobTask; // Store the message as a property
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Check if the current time is greater than the scheduled time
        $scheduledDateTime = Carbon::parse($this->schedule->scheduled_datetime);
        $currentTime = Carbon::now();

        if ($currentTime > $scheduledDateTime) {
            return; // Skip executing the job
        }

        $mqtt = MQTT::connection();
    
        $dock = Dock::findOrFail($this->schedule->dock_id);
        $topic = $dock->mac . '/set/' . $this->jobTask;
        $message = $this->message;
        $mqtt->publish($topic, $message, 0, false);
    
        $mqtt->disconnect();
    
        $this->schedule->job_id = $this->job->getJobId();
        $this->schedule->save();
        // Create a new scheduler log entry
        $schedulerLog = new SchedulerLog();
        $schedulerLog->schedule_id = $this->schedule->id;
        $schedulerLog->user_id = $this->schedule->user_id;
        $schedulerLog->job_id = $this->job->getJobId();
        $schedulerLog->save();
        // Schedule the job again for the next day if the schedule type is "daily"
        if ($this->schedule->type === 'daily' && $this->schedule->exists()) {
            $this->updateNextDaySchedule();
        } elseif ($this->schedule->type === 'weekly' && $this->schedule->exists()) {
            $this->updateNextWeekSchedule();
        } elseif ($this->schedule->type === 'monthly' && $this->schedule->exists()) {
            $this->updateNextMonthSchedule();
        }
        
    }
    protected function updateNextDaySchedule()
    {
        $nextDay = Carbon::parse($this->schedule->scheduled_datetime)->addDay();
        $nextScheduledDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $nextDay->format('Y-m-d') . ' ' . $this->schedule->time);
        
        // Update the schedule's data and time
        $this->schedule->scheduled_datetime = $nextScheduledDateTime;
        $this->schedule->save();
        
        // Schedule the job again for the next day
        ScheduleJob::dispatch($this->schedule, $this->message, $this->jobTask)->delay($nextScheduledDateTime);
    }
    
    /**
     * Update the schedule's data and time for the next week.
     *
     * @return void
     */
    protected function updateNextWeekSchedule()
    {
        $nextWeek = Carbon::parse($this->schedule->scheduled_datetime)->addWeek();
        $nextScheduledDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $nextWeek->format('Y-m-d') . ' ' . $this->schedule->time);
        
        // Update the schedule's data and time
        $this->schedule->scheduled_datetime = $nextScheduledDateTime;
        $this->schedule->save();
        
        // Schedule the job again for the next week
        ScheduleJob::dispatch($this->schedule, $this->message, $this->jobTask)->delay($nextScheduledDateTime);
    }
    
    /**
     * Update the schedule's data and time for the next month.
     *
     * @return void
     */
    protected function updateNextMonthSchedule()
    {
        $nextMonth = Carbon::parse($this->schedule->scheduled_datetime)->addMonth();
        $nextScheduledDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $nextMonth->format('Y-m-d') . ' ' . $this->schedule->time);
        
        // Update the schedule's data and time
        $this->schedule->scheduled_datetime = $nextScheduledDateTime;
        $this->schedule->save();
        
        // Schedule the job again for the next month
        ScheduleJob::dispatch($this->schedule, $this->message, $this->jobTask)->delay($nextScheduledDateTime);
    }

    
    
    
    
    
    
    
    
}

