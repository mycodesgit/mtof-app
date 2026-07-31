<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Applicants;

class DashboardController extends Controller
{
    public function index()
    {
        $appcount = Applicants::count();

        return view('home.dashboard', compact('appcount'));
    }

    public function logout()
    {
        if (\Auth::guard('web')->check()) {
            auth()->guard('web')->logout();
            return redirect()->route('login.index')->with('success', 'You have been Successfully Logged Out');
        } else {
            return redirect()->route('dashboard.index')->with('error', 'No authenticated user to log out');
        }
    }
}
