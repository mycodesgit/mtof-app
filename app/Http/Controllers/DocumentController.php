<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;
use Storage;
use PDF;

use App\Models\Documents;

class DocumentController extends Controller
{
    public function index()
    {
        return view('document.viewlist');
    }

    public function show(Request $request)
    {  
        $data = Documents::all();
        
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title'  => 'required|string|max:255',
                'status' => 'required|in:Active,Inactive',
            ]);

            // $itemName = $request->input('item_descrip'); 
            // $existingItem = Item::where('item_descrip', $itemName)->first();

            // if ($existingItem) {
            //     return response()->json(['error' => true, 'message' => 'Item already exists!']);
            // }

            try {
                Documents::create([
                    'title'     => $validated['title'],
                    'status'    => $validated['status'],
                    'delstatus' => 'Not Deleted',
                ]);

                return response()->json(['success' => true, 'message' => 'Document stored successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Document!']);
            }
        }
    }
}
