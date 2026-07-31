<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Applicants;

class ApplicantController extends Controller
{
    public function index()
    {
        return view('applicant.list');
    }

    public function show(Request $request)
    {  
        $data = Applicants::all();
        
        return response()->json(['data' => $data]);
    }
}
