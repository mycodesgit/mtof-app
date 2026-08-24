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
use App\Models\Signatories;

class SignatoryController extends Controller
{
    public function index()
    {
        $pos = Positions::all();

        return view('signatory.viewlist', compact('pos'));
    }

    public function show(Request $request)
    {  
        $data = Signatories::with(['position'])->get();
        
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'sigfname'  => 'required|string|max:255',
                'sigmname'  => 'required|string|max:255',
                'siglname'  => 'required|string|max:255',
                'sigext'  => 'required|string|max:255',
                'sigposition'  => 'required|string|max:255',
            ]);

            $docName = $request->input('title'); 
            $existingDocs = Signatories::where('title', $docName)->first();

            if ($existingDocs) {
                return response()->json(['error' => true, 'message' => 'Document already exists!']);
            }

            try {
                $authuser = Auth::guard('web')->user()->id;
                Signatories::create([
                    'sigfname' => $request->input('sigfname'),
                    'sigmname' => $request->input('sigmname'),
                    'siglname' => $request->input('siglname'),
                    'sigext' => $request->input('sigext'),
                    'sigposition' => $request->input('sigposition'),
                    'postedBy' => $authuser,
                ]);

                return response()->json(['success' => true, 'message' => 'Document stored successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Document!']);
            }
        }
    }

    public function update(Request $request) 
    {
        $validated = $request->validate([
            'id'          => 'required|exists:signatories,id',
            'sigfname'    => 'required|string|max:255',
            'sigmname'    => 'required|string|max:255',
            'siglname'    => 'required|string|max:255',
        ]);

        try {
            // Check if another signatory with the exact same full name already exists
            $existingSignatory = Signatories::where('sigfname', $request->input('sigfname'))
                ->where('sigmname', $request->input('sigmname'))
                ->where('siglname', $request->input('siglname'))
                ->where('sigext', $request->input('sigext'))
                ->where('id', '!=', $request->input('id'))
                ->first();

            if ($existingSignatory) {
                return response()->json(['error' => true, 'message' => 'Signatory already exists!']);
            }

            $doc = Signatories::findOrFail($request->input('id'));
            $doc->update([
                'sigfname'    => $request->input('sigfname'),
                'sigmname'    => $request->input('sigmname'),
                'siglname'    => $request->input('siglname'),
                'sigext'      => $request->input('sigext'),
                'sigposition' => $request->input('sigposition'),
            ]);

            return response()->json(['success' => true, 'message' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update Signatory!']);
        }
    }

    public function destroy($id) 
    {
        $doc = Signatories::find($id);
        if ($doc) {
            $doc->delstatus = 'Deleted';
            $doc->save();
            return response()->json(['success'=> true, 'message'=>'Document updated to deleted successfully']);
        }
        return response()->json(['error'=> true, 'message'=>'Item not found']);
    }
}
