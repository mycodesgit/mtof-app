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
                'ext' => 'nullable|string|max:255',
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
                    'ext' => $validated['ext'],
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

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'username' => 'required',
            'lname' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'ext' => 'nullable|string|max:255',
        ]);

        try {
            $userName = $request->input('username'); 
            $existingUserAccount = User::where('username', $userName)->where('id', '!=', $request->input('id'))->first();

            if ($existingUserAccount) {
                return response()->json(['error' => true, 'message' => 'User already exists'], 404);
            }
            $user = User::findOrFail($request->input('id'));
            $user->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'ext' => $request->input('ext'),
                'email' => $userName,
            ]);

            return response()->json(['success' => true, 'message' => 'User Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update User'], 404);
        }
    }

    public function userPassUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);

        try {
            $userpass = User::findOrFail($request->input('id'));
            $userpass->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json(['success' => true, 'message' => 'User Password Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update User Password'], 404);
        }
    }

    public function userStatusUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        try {
            $stat = User::findOrFail($request->input('id'));
            $stat->update([
                'status' => $request->input('status'),
        ]);
            return response()->json(['success' => true, 'message' => 'User Status update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update User Status'], 404);
        }
    }
}
