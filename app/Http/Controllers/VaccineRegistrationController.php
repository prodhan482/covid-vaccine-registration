<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VaccinationSchedule;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VaccineRegistrationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nid' => [
                'required',
                'unique:users,nid',
            ],
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
        ]);

        $user = User::create([
            'nid' => $request->nid, 
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->nid),
        ]);

        $vaccineCenter = VaccineCenter::find($request->vaccine_center_id);
        $this->scheduleVaccination($user, $vaccineCenter);
        return redirect()->route('search')->with('status', 'Registration successful! We are processing your request.');
    }




    private function scheduleVaccination($user, $vaccineCenter)
    {
        $today = Carbon::today();
        $nextAvailableDate = $this->getNextAvailableDate($vaccineCenter, $today);

        VaccinationSchedule::create([
            'user_id' => $user->id,
            'vaccine_center_id' => $vaccineCenter->id,
            'schedule_date' => $nextAvailableDate,
            'status' => 'Scheduled',
        ]);
    }

    private function getNextAvailableDate($vaccineCenter, $startingDate)
    {
        $date = Carbon::parse($startingDate);

        while (true) {
            if ($date->isFriday() || $date->isSaturday()) {
                $date->addDay();
                continue;
            }

            $scheduledCount = VaccinationSchedule::where('vaccine_center_id', $vaccineCenter->id)
                ->where('schedule_date', $date)
                ->count();

            if ($scheduledCount < $vaccineCenter->capacity) {
                return $date;
            }

            $date->addDay();
        }
    }


    public function searchForm()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $request->validate(['nid' => 'required']);
    
        $user = User::where('nid', $request->nid)->first();
    
        if (!$user) {
            return view('status', [
                'status' => 'Not registered',
                'registrationLink' => url('/'),
                'user' => null
            ]);
        }
    
        $registration = $user->vaccinationSchedules()->with('vaccineCenter')->first();
    
        if (!$registration) {
            return view('status', [
                'status' => 'Not scheduled',
                'registration' => null,
                'user' => $user 
            ]);
        }
    
        $today = $registration->schedule_date;
        $status = $this->getStatus($registration);
    
        $rank = null;
        if ($status === 'Scheduled') {
            $rank = User::whereHas('vaccinationSchedules', function ($query) use ($registration, $today) {
                $query->where('vaccine_center_id', $registration->vaccine_center_id)
                    ->whereDate('schedule_date', $today);
            })
            ->whereDate('created_at', $today)
            ->where('created_at', '<', $user->created_at)
            ->count() + 1;
        }
    
        return view('status', [
            'status' => $status,
            'registration' => $registration,
            'centerName' => $registration->vaccineCenter->name,
            'rank' => $rank,
            'user' => $user
        ]);
    }
    





    private function getStatus($registration)
    {
        if ($registration->schedule_date < now()) {
            return 'Vaccinated'; 
        }
    
        return $registration->status ?? 'Scheduled';
    }
    
}
