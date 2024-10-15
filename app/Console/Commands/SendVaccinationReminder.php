<?php

namespace App\Console\Commands;

use App\Mail\VaccinationNotification;
use App\Models\VaccinationSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendVaccinationReminder extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Send vaccination reminders for the next day at 9 PM';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();

        $usersScheduled = VaccinationSchedule::with('user')
            ->where('schedule_date', $tomorrow)
            ->get()
            ->groupBy('user_id');

        foreach ($usersScheduled as $schedules) {
            $schedule = $schedules->first();

            try {
                Mail::to($schedule->user->email)->send(new VaccinationNotification($schedule));
            } catch (\Exception $e) {
                \Log::error("Failed to send email to user {$schedule->user->email}: " . $e->getMessage());
            }
        }

        $this->info('Vaccination reminders sent successfully!');
    }
}
