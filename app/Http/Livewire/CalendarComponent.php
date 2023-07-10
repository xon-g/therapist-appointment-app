<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CalendarComponent extends Component
{
    public $therapist;

    public function mount($therapist)
    {
        $this->therapist = $therapist;
    }

    public function render()
    {
        return view('livewire.calendar-component');
    }
}
