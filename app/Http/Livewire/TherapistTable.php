<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TherapistTable extends Component
{   

    public $therapists;

    public function mount()
    {
        $this->loadTherapists();
    }

    public function loadTherapists()
    {   
        $this->therapists = User::where('role', 'therapist')->get();
    }
    
    public $input = "";

    public function updated($name, $value)
    {
        if ($name === 'input') {$this->search();};
    }

    public function search()
    {   
        $q = User::where('role', 'therapist');
        if ($this->input === "" ) {
            $this->therapists = $q->get();
        } else {
            $this->therapists = $q
            ->where('name', 'like', '%' . $this->input . '%')
            ->orWhere('username', 'like', '%' . $this->input . '%')
            ->orWhere('address', 'like', '%' . $this->input . '%')
            ->orWhereHas('services', function ($q) {
                $q->where('name', 'like', '%' . $this->input . '%');
            })->get();
            ;
            ;
        }

    }

    public function render()
    {
        return view('livewire.therapist-table');
    }
}
