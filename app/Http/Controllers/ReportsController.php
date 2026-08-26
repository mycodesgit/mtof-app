<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Applicants;
use App\Models\Signatories;
use App\Models\User;

class ReportsController extends Controller
{
    public function index()
    {
        return view('report.generaterep');
    }

    public function store(Request $request)
    {
        return view('report.generaterepresult');
    }

    public function show(Request $request)
    {  
        $query = Applicants::query();

        // Filter by Franchise Status
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        });

        // Filter by Month (created_at)
        $query->when($request->filled('month'), function ($q) use ($request) {
            $q->whereMonth('created_at', $request->month);
        });

        // Filter by Year (created_at)
        $query->when($request->filled('year'), function ($q) use ($request) {
            $q->whereYear('created_at', $request->year);
        });

        $data = $query->latest()->get();
        
        return response()->json(['data' => $data]);
    }
}
