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
        $data = Documents::where('delstatus', '=', 'Not Deleted')->get();
        
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title'  => 'required|string|max:255',
                'status' => 'required|in:Active,Inactive',
            ]);

            $docName = $request->input('title'); 
            $existingDocs = Documents::where('title', $docName)->first();

            if ($existingDocs) {
                return response()->json(['error' => true, 'message' => 'Document already exists!']);
            }

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

    public function update(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'title'  => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        try {
            $docName = $request->input('title'); 
            $existingDocs = Documents::where('title', $docName)->where('id', '!=', $request->input('id'))->first();

            if ($existingDocs) {
                return response()->json(['error'=> true, 'message' => 'Document already exists!']);
            }

            $doc = Documents::findOrFail($request->input('id'));
            $doc->update([
                'title'     => $request->input('title'),
                'status'    => $request->input('status'),
        ]);
            return response()->json(['success' => true, 'message' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update Document!']);
        }
    }

    public function destroy($id) 
    {
        $doc = Documents::find($id);
        if ($doc) {
            $doc->delstatus = 'Deleted';
            $doc->save();
            return response()->json(['success'=> true, 'message'=>'Document updated to deleted successfully']);
        }
        return response()->json(['error'=> true, 'message'=>'Item not found']);
    }
}
