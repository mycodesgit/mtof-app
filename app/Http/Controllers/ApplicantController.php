<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

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
}
