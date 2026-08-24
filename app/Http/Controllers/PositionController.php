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

use App\Models\Positions;

class PositionController extends Controller
{
    public function index()
    {
        return view('position.list');
    }

    public function show(Request $request)
    {  
        $data = Positions::all();
        
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name'  => 'required|string|max:255',
            ]);

            $positionName = $request->input('name'); 
            $existingDocs = Positions::where('name', $positionName)->first();

            if ($existingDocs) {
                return response()->json(['error' => true, 'message' => 'Position already exists!']);
            }

            try {
                Positions::create([
                    'name'     => $validated['name'],
                ]);

                return response()->json(['success' => true, 'message' => 'Position stored successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Position!']);
            }
        }
    }

    public function update(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'name'  => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        try {
            $posName = $request->input('name'); 
            $existingPosition = Positions::where('name', $posName)->where('id', '!=', $request->input('id'))->first();

            if ($existingPosition) {
                return response()->json(['error'=> true, 'message' => 'Position already exists!']);
            }

            $pos = Positions::findOrFail($request->input('id'));
            $pos->update([
                'name'     => $request->input('name'),
                'status'    => $request->input('status'),
        ]);
            return response()->json(['success' => true, 'message' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update Position!']);
        }
    }

    public function destroy($id) 
    {
        $pos = Positions::find($id);
        if ($pos) {
            $pos->pdelstatus = 'Deleted';
            $pos->save();
            return response()->json(['success'=> true, 'message'=>'Position updated to deleted successfully']);
        }
        return response()->json(['error'=> true, 'message'=>'Position not found']);
    }
}
