<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DebugBar;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CalendarComponent extends Component
{
    public $therapist;
    // public $startTime;
    // public $endTime;

    public function mount($therapist)
    {
        $this->therapist = $therapist;
    }

    public function bookNow($startTime, $endTime)
    {   
        $debugbar = new DebugBar();
        $debugbar->addCollector(new MessagesCollector());
        $debugbar['messages']->info('hello world');

        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        // Check for overlapping appointments with therapist
        $buffer = 1;
        $therapistAppointments = Appointment::where('therapist_id', $this->therapist->id)
        ->where(function ($query) use ($startTime, $endTime) {
            $query
            ->where(function ($query) use ($startTime, $endTime) {
                $query
                ->where('appointment_start_date', '>=', $startTime)
                ->where('appointment_start_date', '<', $endTime);
            })
            ->orWhere(function ($query) use ($startTime, $endTime) {
                $query
                ->where('appointment_end_date', '>', $startTime)
                ->where('appointment_end_date', '<=', $endTime);
            });
        })
        ->exists();

        if ($therapistAppointments) {
            // There is an overlapping appointment with the therapist
            return redirect()->back()->with('error', 'There is an overlapping appointment with the therapist. Please reschedule.');
        }

        // Check for overlapping appointments with the user
        $userAppointments = Appointment::where('user_id', Auth::user()->id)
        ->where(function ($query) use ($startTime, $endTime) {
            $query
            ->where(function ($query) use ($startTime, $endTime) {
                $query
                ->where('appointment_start_date', '>=', $startTime)
                ->where('appointment_start_date', '<', $endTime);
            })
            ->orWhere(function ($query) use ($startTime, $endTime) {
                $query
                ->where('appointment_end_date', '>', $startTime)
                ->where('appointment_end_date', '<=', $endTime);
            });
        })
        ->exists();

        if ($userAppointments) {
            // There is an overlapping appointment with the user
            return redirect()->back()->with('error', 'You have an overlapping appointment. Please reschedule.');
        } 
        
        // Proceed to create a new appointment
        $appointment = new Appointment();
        $appointment->user_id = Auth::user()->id;
        $appointment->therapist_id = $this->therapist->id;
        $appointment->appointment_start_date = $startTime;
        $appointment->appointment_end_date = $endTime;
        $appointment->save();
        
        // Success message or redirection
        return redirect()->back()->with('success', 'Appointment created successfully.');
    }

    public function render()
    {
        return view('livewire.calendar-component');
    }
}
