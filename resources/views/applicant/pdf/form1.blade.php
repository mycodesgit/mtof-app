<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TRU Form 1: Application Form</title>
    <style>
        @page {
            margin: 40px 50px;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #000;
        }
        .text-center {
            text-align: center;
        }
        .text-italic {
            font-style: italic;
        }
        .text-bold {
            font-weight: bold;
        }
        .underline {
            text-decoration: underline;
            font-weight: bold;
        }
        
        /* Header styling */
        .sub-header {
            font-size: 10pt;
            margin-bottom: 10px;
        }
        .header-table {
            width: 100%;
            margin-bottom: 10px;
        }
        .header-table td {
            vertical-align: middle;
        }
        .logo {
            width: 90px;
            height: auto;
        }
        .header-title-1 {
            font-size: 13pt;
        }
        .header-title-2 {
            font-size: 15pt;
            color: #C58B00; /* Gold/yellowish tone matching image */
            font-weight: bold;
        }
        .header-title-3 {
            font-size: 14pt;
            color: #006600; /* Green tone matching image */
            font-style: italic;
            font-weight: bold;
        }
        .doc-title {
            font-size: 13pt;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        /* Body Sections */
        .content {
            margin-top: 10px;
            text-align: justify;
        }
        ol {
            padding-left: 20px;
            margin-top: 5px;
        }
        li {
            margin-bottom: 8px;
        }

        /* Specs Table */
        .specs-table {
            width: 100%;
            margin: 5px 0 10px 0;
            border-collapse: collapse;
        }
        .specs-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        /* Checkboxes */
        .checkbox-table {
            width: 80%;
            margin: 5px auto 10px 20px;
        }
        .checkbox-table td {
            padding: 2px 0;
        }
        .checkbox-box {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            text-align: center;
            line-height: 10px;
            font-size: 15px;
            font-weight: bold;
            margin-right: 5px;
            vertical-align: middle;
        }

        /* Signatures Section */
        .signature-section {
            margin-top: 40px;
            text-align: center;
        }
        .sig-line {
            width: 280px;
            border-bottom: 1px solid #000;
            margin: 0 auto 5px auto;
        }
        
        /* Officials Table */
        .officials-table {
            width: 100%;
            margin-top: 30px;
        }
        .officials-table td {
            vertical-align: top;
            width: 33.33%;
        }
    </style>
</head>
<body>

    <!-- Top Sub-header -->
    <div class="sub-header text-italic">
        TRU Form 1: Application Form
    </div>

    <!-- Header with Logo & Titles -->
    <table class="header-table">
        <tr>
            <td style="width: 20%; text-align: right; padding-right: 15px;">
                <!-- Replace with path to your municipal logo if available -->
                <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
            </td>
            <td style="width: 80%; text-align: center; padding-right: 10%;">
                <div class="header-title-1">Province of Negros Occidental</div>
                <div class="header-title-2">MUNICIPAL GOVERNMENT OF CANDONI</div>
                <div class="header-title-3">Municipal Tricycle Franchising Regulatory Board</div>
                <div class="header-title-3">Tricycle Regulation Unit</div>
                <div>------ooOoo------</div>
            </td>
        </tr>
    </table>

    <!-- Main Title -->
    <div class="doc-title text-center">
        APPLICATION FOR MOTORIZED TRICYCLE<br>
        OPERATOR'S FRANCHISE (MTOF)
    </div>

    <!-- Preamble -->
    <div class="content">
        I, <span class="underline">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }} {{ $applicant->ext }}</span> 
        of legal age, Filipino and a resident of Barangay <span class="underline">{{ $applicant->brgy }}</span> 
        with Tax Identification No.: <span class="underline">{{ $applicant->tin_no }}</span> 
        hereby applied for a Motorized Tricycle Operator's Franchise to operate a tricycle-for-hire within this municipality. I further declare the following:
    </div>

    <!-- Numbered Points -->
    <ol class="content">
        <li>
            That I am an owner of a motorcycle component of tricycle unit described hereunder duly registered with the Land Transportation Office.
            
            <table class="specs-table">
                <tr>
                    <td style="width: 33%;">Make: <span class="underline">{{ $applicant->mtof_make }}</span></td>
                    <td style="width: 33%;">Color: <span class="underline">{{ $applicant->mtof_color }}</span></td>
                    <td style="width: 34%;">CC: <span class="underline">{{ $applicant->mtof_cc }}</span></td>
                </tr>
                <tr>
                    <td>Plate No.: <span class="underline">{{ $applicant->plate_no }}</span></td>
                    <td>CR No.: <span class="underline">{{ $applicant->cr_no }}</span></td>
                    <td>OR No.: <span class="underline">{{ $applicant->or_no }}</span></td>
                </tr>
                <tr>
                    <td>Date Acq.: <span class="underline">{{ $applicant->date_acq }}</span></td>
                    <td>Engine: <span class="underline">{{ $applicant->motor_no }}</span></td>
                    <td>Chassis: <span class="underline">{{ $applicant->chassis_no }}</span></td>
                </tr>
                <tr>
                    <td colspan="3">OR Date: <span class="underline">{{ $applicant->or_date }}</span></td>
                </tr>
            </table>
        </li>

        <li>That I carry a common carrier's insurance sufficient to answer for any liability I may incur to passenger in case of accident.</li>
        <li>That I am capable of meeting all the duties and responsibilities incident to an MTOF.</li>
        <li>That I am willing without reservation to subject myself and my operation under the provisions of Municipal Ordinance No. 2021-001, having read and thoroughly understood the same.</li>
        <li>
            That I am applying to operate in the following authorized tricycle route or zone:<br>
            <span class="underline" style="margin-left: 15px;">{{ $applicant->brgy }}</span>
        </li>
        <li>
            That above said unit will be operated by the driver named <span class="underline">{{ $applicant->drivers_name }}</span> 
            with Professional Driver's License No.: <span class="underline">{{ $applicant->driver_license }}</span> 
            valid until <span class="underline">{{ $applicant->valid }}</span>.
        </li>
        <li>
            That the driver bears the following clearances and documents:
            <table class="checkbox-table" style="width: 100%;">
        @foreach($documents->chunk(2) as $chunk)
            <tr>
                @foreach($chunk as $doc)
                    <td style="width: 50%;">
                        <span class="checkbox-box">
                            @if($doc->is_selected)
                                <span style="font-family: DejaVu Sans, sans-serif;">&#10003;</span>
                            @endif
                        </span>
                        {{ $doc->title }} {{-- Replace with your actual column name (e.g., name, doc_title) --}}
                    </td>
                @endforeach

                {{-- Fill empty cell if row has an odd number of items --}}
                @if($chunk->count() < 2)
                    <td style="width: 50%;"></td>
                @endif
            </tr>
        @endforeach
    </table>
        </li>
        <li>I hereby certify that the foregoing facts are true and correct.</li>
    </ol>

    <!-- Applicant Signature -->
    <div class="signature-section">
        <div class="sig-line"></div>
        <div>Signature of Applicant & Date</div>
    </div>

    <table class="officials-table">
        <tr>
            <!-- Processed -->
            <td>
                <div class="text-bold">Processed:</div>
                <br><br>
                @if(isset($signatories['Processed']))
                    <div class="text-bold">
                        {{ strtoupper(trim("{$signatories['Processed']->sigfname} {$signatories['Processed']->sigmname} {$signatories['Processed']->siglname} {$signatories['Processed']->sigext}")) }}
                    </div>
                    {{-- <div>{{ $signatories['Processed']->position_name ?? 'TRU Staff' }}</div> --}}
                    <div>TRU Staff</div>
                @else
                    <div class="text-bold">___________________</div>
                    <div>TRU Staff</div>
                @endif
            </td>

            <!-- Verified -->
            <td>
                <div class="text-bold">Verified:</div>
                <br><br>
                @if(isset($signatories['Verified']))
                    <div class="text-bold">
                        {{ strtoupper(trim("{$signatories['Verified']->sigfname} {$signatories['Verified']->sigmname} {$signatories['Verified']->siglname} {$signatories['Verified']->sigext}")) }}
                    </div>
                    {{-- <div>{{ $signatories['Verified']->position_name ?? 'TRU Staff' }}</div> --}}
                    <div>TRU Staff</div>
                @else
                    <div class="text-bold">___________________</div>
                    <div>TRU Staff</div>
                @endif
            </td>

            <!-- Noted -->
            <td>
                <div class="text-bold">Noted:</div>
                <br><br>
                @if(isset($signatories['Noted']))
                    <div class="text-bold">
                        {{ strtoupper(trim("{$signatories['Noted']->sigfname} {$signatories['Noted']->sigmname} {$signatories['Noted']->siglname} {$signatories['Noted']->sigext}")) }}
                    </div>
                    {{-- <div>{{ $signatories['Noted']->position_name ?? 'TRU Head' }}</div> --}}
                    <div>TRU Head</div>
                @else
                    <div class="text-bold">___________________</div>
                    <div>TRU Head</div>
                @endif
            </td>
        </tr>
    </table>
    

</body>
</html>