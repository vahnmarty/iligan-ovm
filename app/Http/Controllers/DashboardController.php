<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if($user->hasRole('user'))
        {
            return view('home');
        }

        return view('dashboard');
    }
}
