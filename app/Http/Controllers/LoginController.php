<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function storelogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:5|max:20',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && $user->status == 2) {
            return redirect()->back()->with('error', 'Account is disabled');
        }

        $validatedUser = auth()->guard('web')->attempt([
            'username' => $request->username,
            'password' => $request->password,
            'status' => 1,
        ]);

        if ($validatedUser) {
            return redirect()->route('dashboard.index')->with('success', 'You have successfully logged in.');
        } 
        else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
}
