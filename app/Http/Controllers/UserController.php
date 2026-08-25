<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Storage;
use PDF;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user.listuser');
    }

    public function show()
    {  
        $data = User::all();
        
        return response()->json(['data' => $data]);
    }

    public function create(Request $request) 
    {

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'lname' => 'required|string|max:255',
                'fname' => 'required|string|max:255',
                'mname' => 'nullable|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|string|min:5',
            ]);

            $userName = $request->input('username'); 
            $existingUserAccount = User::where('username', $userName)->first();

            if ($existingUserAccount) {
                return response()->json(['error' => true, 'message' => 'User already exists'], 404);
            }

            try {
                $userid = User::create([
                    'lname' => $validated['lname'],
                    'fname' => $validated['fname'],
                    'mname' => $validated['mname'],
                    'username' => $validated['username'],
                    'password' => Hash::make($validated['password']),
                    'role' => 2,
                    'remember_token' => Str::random(60),
                ]);

                return response()->json(['success' => true, 'message' => 'User stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store user'], 404);
            }
        }
    }
}
