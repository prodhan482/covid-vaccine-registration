<?php

namespace App\Console\Commands;

use App\Models\VaccinationSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Twilio\Rest\Client;

class SendVaccinationSMS extends Command
{


    protected $signature = 'sms:sendVaccinationReminders';
    protected $description = 'Send vaccination SMS reminders to users scheduled for vaccination tomorrow';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
        $usersScheduled = VaccinationSchedule::with('user', 'vaccineCenter')
            ->where('schedule_date', $tomorrow)
            ->get()
            ->groupBy('user_id');

        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $twilio_number = config('services.twilio.number');

        $client = new Client($sid, $token);

        foreach ($usersScheduled as $userId => $schedules) {
            $user = $schedules->first()->user;
            $vaccineCenter = $schedules->first()->vaccineCenter;

            $message = "Dear {$user->name},\n\n" .
                "This is a reminder for your vaccination appointment:\n\n" .
                "Date: " . \Carbon\Carbon::parse($schedules->first()->schedule_date)->format('l, F j, Y') . "\n" .
                "Location: {$vaccineCenter->name}\n\n" .
                "Please arrive on time for your appointment.\n\n" .
                "If you have any questions, feel free to contact us.\n\n" .
                "Thank you,\nThe Vaccination Team";

            $client->messages->create(
                $user->phone, // to
                [
                    'from' => $twilio_number,
                    'body' => $message
                ]
            );

            $this->info('SMS sent to: ' . $user->phone);
        }

        $this->info('All SMS reminders have been sent.');
    }
    
}
