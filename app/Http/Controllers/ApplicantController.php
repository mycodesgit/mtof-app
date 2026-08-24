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

use App\Models\Applicants;
use App\Models\Documents;
use App\Models\ApplicantDocs;

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

    public function view($id)
    {
        $applicant = Applicants::findOrFail($id);

        return view('applicant.listviewform', compact('applicant'));
    }

    public function viewPDFform1($id) 
    {
        $applicant = Applicants::findOrFail($id);

        // Get assigned document IDs for this applicant
        $assignedDocIds = ApplicantDocs::where('appID', $id)
            ->pluck('docID')
            ->map(fn($docId) => (int)$docId)
            ->toArray();

        // Fetch active documents and mark selected status
        $documents = Documents::where('status', 'Active')
            ->where('delstatus', 'Not Deleted')
            ->get()
            ->map(function ($doc) use ($assignedDocIds) {
                $doc->is_selected = in_array((int)$doc->id, $assignedDocIds, true);
                return $doc;
            });

        $data = [
            'applicant' => $applicant,
            'documents' => $documents,
        ];

        $pdf = PDF::loadView('applicant.pdf.form1', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream('TRU_Form1_' . $applicant->id . '.pdf');
    }

    public function viewPDFform2($id) 
    {
        $applicant = Applicants::findOrFail($id);

        $data = [
            'applicant' => $applicant,
        ];

        $pdf = PDF::loadView('applicant.pdf.form2',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream('TRU_Form2_' . $applicant->id . '.pdf');
    }
    
    public function viewPDFform3($id) 
    {
        $applicant = Applicants::findOrFail($id);

        $data = [
            'applicant' => $applicant,
        ];

        $pdf = PDF::loadView('applicant.pdf.form3',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream('TRU_Form3_' . $applicant->id . '.pdf');
    }
    
    public function viewPDFaou1($id) 
    {
        $applicant = Applicants::findOrFail($id);

        $data = [
            'applicant' => $applicant,
        ];

        $pdf = PDF::loadView('applicant.pdf.aou1',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream('TRU_AOU1_' . $applicant->id . '.pdf');
    }
    
    public function viewPDFaou2($id) 
    {
        $applicant = Applicants::findOrFail($id);

        $data = [
            'applicant' => $applicant,
        ];

        $pdf = PDF::loadView('applicant.pdf.aou2',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream('TRU_AOU2_' . $applicant->id . '.pdf');
    }

    public function getApplicantDocs($id)
    {
        try {
            // Retrieve document IDs associated with this applicant ID
            $assignedDocIds = ApplicantDocs::where('appID', $id)
                ->pluck('docID')
                ->map(fn($docId) => (int)$docId)
                ->toArray();

            // Fetch active documents and set 'is_selected' boolean
            $documents = Documents::where('status', 'Active')
                ->where('delstatus', 'Not Deleted')
                ->get()
                ->map(function ($doc) use ($assignedDocIds) {
                    $doc->is_selected = in_array((int)$doc->id, $assignedDocIds, true);
                    return $doc;
                });

            return response()->json(['data' => $documents]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error loading documents: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeApplicantDocs(Request $request)
    {
        try {
            $validated = $request->validate([
                'appID'    => 'required|integer|exists:applicants,id',
                'docIDs'   => 'nullable|array',
                'docIDs.*' => 'integer|exists:documents,id',
            ]);

            $appID = $validated['appID'];
            $docIDs = $request->input('docIDs', []);
            $postedBy = Auth::id();

            // 1. Remove unchecked options
            ApplicantDocs::where('appID', $appID)
                ->whereNotIn('docID', $docIDs)
                ->delete();

            // 2. Add or keep checked options
            foreach ($docIDs as $docID) {
                ApplicantDocs::updateOrCreate(
                    ['appID' => $appID, 'docID' => $docID],
                    ['postedBy' => $postedBy]
                );
            }

            return response()->json([
                'status'  => true,
                'message' => 'Applicant documents updated successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to save selections: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        // 1. Validate incoming form inputs
        $validated = $request->validate([
            'id'             => 'required|exists:applicants,id',
            'fname'          => 'required|string|max:255',
            'mname'          => 'nullable|string|max:255',
            'lname'          => 'required|string|max:255',
            'ext'            => 'nullable|string|max:50',
            'brgy'           => 'nullable|string|max:255',
            'tin_no'         => 'nullable|string|max:100',

            // Vehicle Information
            'mtof_make'      => 'nullable|string|max:255',
            'mtof_color'     => 'nullable|string|max:100',
            'mtof_cc'        => 'nullable|string|max:100',
            'motor_no'       => 'nullable|string|max:100',
            'chassis_no'     => 'nullable|string|max:100',
            'plate_no'       => 'required|string|max:100',
            'body_no'        => 'nullable|string|max:100',
            'route_no'       => 'nullable|string|max:100',
            'color_code'     => 'nullable|string|max:100',

            // Registration Details
            'cr_no'          => 'nullable|string|max:100',
            'or_no'          => 'nullable|string|max:100',
            'or_date'        => 'nullable|date',
            'date_acq'       => 'nullable|date',
            'valid'          => 'nullable|date',

            // Driver Information
            'drivers_name'   => 'nullable|string|max:255',
            'driver_license' => 'nullable|string|max:100',

            // Other Details
            'mtof_id'        => 'nullable|string|max:100',
            'p_name'         => 'nullable|string|max:255',

            // Dates
            'date_issued'    => 'nullable|date',
            'date_expired'   => 'nullable|date',
        ]);

        try {
            // 2. Optional: Duplicate check (e.g., checking if another applicant uses the same plate number)
            $existingApplicant = Applicants::where('fname', $validated['fname'])
                ->where('mname', $validated['mname'])
                ->where('lname', $validated['lname'])
                ->where('ext', $validated['ext'])
                ->where('id', '!=', $request->input('id'))
                ->first();

            if ($existingApplicant) {
                return response()->json([
                    'error'   => true, 
                    'message' => 'An applicant with this plate number already exists!'
                ], 422);
            }

            // 3. Find and update record
            $applicant = Applicants::findOrFail($request->input('id'));
            $applicant->update($validated);

            return response()->json([
                'success' => true, 
                'message' => 'Applicant updated successfully',
                'data'    => $applicant
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error'   => true, 
                'message' => 'Applicant record not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => true, 
                'message' => 'Failed to update applicant details!'
            ], 500);
        }
    }

    public function destroy($id) 
    {
        $applcnt = Applicants::find($id);
        if ($applcnt) {
            $applcnt->delstatus = 'Deleted';
            $applcnt->save();
            return response()->json(['success'=> true, 'message'=>'Document updated to deleted successfully']);
        }
        return response()->json(['error'=> true, 'message'=>'Item not found']);
    }
}
