<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
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
    
    public $name = "";
    public $services = "";

    public $isTrue = 'true';

    public function search()
    {   
        $query = User::where('role', 'admin')->get(); 
        if ($this->name) {
            $this->therapists = User::where('role', 'admin')->where('name', $this->name)->get();
        }
            // if ($this->services) {
            //     $query->where('services', 'LIKE', '%' . $this->services . '%');
            // }
        

        // if (count($query) > 0 ) {
        //     $this->therapists = $query;
        // };

        if ($this->name === '' or $this->services === "") {
            $this->therapists =  User::where('role', 'therapist')->get();
        }
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
