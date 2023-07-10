<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class BookCalendar extends Component
{
    public $therapist;

    public function mount($therapistId)
    {
        $this->loadTherapist($therapistId);
    }
    
    public function loadTherapist($therapistId)
    {   
        $this->therapist = User::where('role', 'therapist')->find($therapistId);
    }

    public function render()
    {
        return view('livewire.book-calendar');
    }
}
