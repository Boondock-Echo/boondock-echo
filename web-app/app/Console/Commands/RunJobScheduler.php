<?php

namespace App\Console\Commands;


use App\Models\Schedule;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ScheduleJob;
use Carbon\Carbon;

class RunJobScheduler extends Command
{
    protected $signature = 'scheduler:run';
    protected $description = 'Add jobs from the scheduler to their respective queues';

    public function handle()
    {
        try {
            $schedules = Schedule::all();

            foreach ($schedules as $schedule) {
                $queue = $schedule->type; // Replace 'type' with the actual column name for queue information

                $jobTask = ($schedule->task === 'record_line_in_on' || $schedule->task === 'record_line_in_off') ? 'record_line_in' : ($schedule->task === 'set_speaker_on' || $schedule->task === 'set_speaker_off' ? 'spkr_on' : ($schedule->task === 'upload_on' || $schedule->task === 'upload_off' ? 'upload_line_in' : $schedule->task));
               
                $message = ($schedule->task === 'record_line_in_on' || $schedule->task === 'set_speaker_on' || $schedule->task === 'upload_on' || $schedule->task === 'reboot') ? '1' : '0';

                // Calculate the delay for the job based on the scheduled datetime
                $delay = Carbon::now()->diffInSeconds(Carbon::parse($schedule->scheduled_datetime));

                // Get the user's timezone
                $user = User::find($schedule->user_id);
                $timezone = $user->timezone;
    
                // Adjust the scheduled datetime to the user's timezone
                $scheduledDateTime = Carbon::parse($schedule->scheduled_datetime)->shiftTimezone($timezone);
    
                // Schedule the job with the adjusted scheduled datetime and delay
                ScheduleJob::dispatch($schedule, $message, $jobTask)->delay($scheduledDateTime);
            }

            $this->info('Jobs added to queues successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while running the job scheduler: ' . $e->getMessage());
        }
    }
}