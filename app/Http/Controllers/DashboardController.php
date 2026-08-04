<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Applicants;
use App\Models\Signatories;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // General Counts
        $appcount  = Applicants::count();
        $signcount = Signatories::count(); // Adjust model name if needed
        $userCount = User::count();

        // Status Counts based on image and Applicant fields
        $expiredOrCrCount = Applicants::where('status', 'Expired OR/CR')->count();
        $privateCount     = Applicants::where('status', 'Private')->count();
        $bothCount        = Applicants::where('status', 'Both')->count();
        $releasedCount    = Applicants::where('status', 'Released')->count();
        $validatedCount   = Applicants::where('status', 'Validated')->count();
        $revokedCount     = Applicants::where('status', 'Revoked')->count();

        // Expired Franchises (Checking against date_expired field)
        $expiredFranchiseCount = Applicants::where('date_expired', '<', now())->count();

        // Recent Registration Activity
        $recentApplicants = Applicants::latest()->take(5)->get();

        return view('home.dashboard', compact(
            'appcount',
            'signcount',
            'userCount',
            'expiredOrCrCount',
            'privateCount',
            'bothCount',
            'releasedCount',
            'validatedCount',
            'revokedCount',
            'expiredFranchiseCount',
            'recentApplicants'
        ));
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
