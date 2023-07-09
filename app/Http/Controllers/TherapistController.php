<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function TherapistDashboard() {

        
        return view('therapist.dashboard');
    }
}
