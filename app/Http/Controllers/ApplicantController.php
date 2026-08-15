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

        $data = [
            'applicant' => $applicant,
        ];

        $pdf = PDF::loadView('applicant.pdf.form1',  $data)->setPaper('Legal', 'portrait');
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
}
