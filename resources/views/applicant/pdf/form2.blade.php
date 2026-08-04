<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TRU Form 2: Inspection Form</title>
    <style>
        @page {
            margin: 40px 50px;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
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
            width: 85px;
            height: auto;
        }
        .header-title-1 {
            font-size: 12pt;
        }
        .header-title-2 {
            font-size: 14pt;
            color: #C58B00; /* Gold/yellow tone */
            font-weight: bold;
        }
        .header-title-3 {
            font-size: 13pt;
            color: #006600; /* Green tone */
            font-style: italic;
            font-weight: bold;
        }

        /* Memorandum Table */
        .memo-table {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        .memo-table td {
            padding: 2px 0;
            vertical-align: top;
        }
        .doc-title {
            font-size: 13pt;
            font-weight: bold;
        }

        /* MTOF Badge Box */
        .mtof-box {
            border: 2px solid #006600;
            border-radius: 20px;
            padding: 6px 15px;
            display: inline-block;
            font-weight: bold;
            font-size: 12pt;
        }

        .divider {
            border-bottom: 1px dashed #000;
            margin: 10px 0 15px 0;
        }

        /* Content & Particulars */
        .content {
            text-align: justify;
            margin-bottom: 15px;
        }

        .specs-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        .specs-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        /* Accessories & Checkboxes */
        .section-title {
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        
        .checkbox-table {
            width: 100%;
            margin-bottom: 15px;
        }
        .checkbox-table td {
            padding: 3px 0;
            width: 33.33%;
        }
        .checkbox-box {
            display: inline-block;
            width: 11px;
            height: 11px;
            border: 1px solid #000;
            margin-right: 5px;
            vertical-align: middle;
        }

        /* Signatures Section */
        .signature-section {
            margin-top: 30px;
            text-align: center;
        }
        .sig-block {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

    <!-- Sub Header -->
    <div class="sub-header text-italic">
        TRU Form 2: Inspection Form
    </div>

    <!-- Main Header -->
    <table class="header-table">
        <tr>
            <td style="width: 20%; text-align: right; padding-right: 15px;">
                <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
            </td>
            <td style="width: 80%; text-align: center; padding-right: 10%;">
                <div class="header-title-1">Province of Negros Occidental</div>
                <div class="header-title-2">MUNICIPAL GOVERNMENT OF CANDONI</div>
                <div class="header-title-3">Municipal Tricycle Franchising & Regulatory Board</div>
                <div>------ooOoo------</div>
            </td>
        </tr>
    </table>

    <!-- Memorandum Section -->
    <table class="memo-table">
        <tr>
            <td style="width: 70%;">
                <table style="width: 100%;">
                    <tr>
                        <td colspan="3" class="doc-title">MEMORANDUM</td>
                    </tr>
                    <tr>
                        <td style="width: 15%; font-weight: bold;">To</td>
                        <td style="width: 5%;">:</td>
                        <td style="font-weight: bold;">MUNICIPAL TRAFFIC UNIT</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-italic text-bold">Attn: PNP Traffic Division Cheif</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">From</td>
                        <td>:</td>
                        <td style="font-weight: bold;">MTFRB CHAIRPERSON</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Subject</td>
                        <td>:</td>
                        <td style="font-weight: bold;">INSPECTION REPORT</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Date</td>
                        <td>:</td>
                        <td><span class="underline">{{ date('l, m/d/Y') }}</span></td>
                    </tr>
                </table>
            </td>
            <td style="width: 30%; text-align: right; vertical-align: top;">
                <div class="mtof-box">
                    MTOF NO. <span class="underline">{{ $applicant->mtof_no ?? '4412' }}</span>
                </div>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- Preamble -->
    <div class="content">
        This is to certify that upon INSPECTION of motorized tricycle-for-hire owned by 
        <span class="underline">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }}</span> 
        a resident of Barangay <span class="underline">{{ $applicant->brgy }}</span> has the following particulars, and is hereby endorsed as herein specified:
    </div>

    <!-- Vehicle Particulars -->
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
            <td>OR Date: <span class="underline">{{ $applicant->or_date }}</span></td>
            <td>Color Code: <span class="underline">{{ $applicant->color_code ?? 'Red' }}</span></td>
        </tr>
        <tr>
            <td>Route: <span class="underline">{{ $applicant->brgy }}</span></td>
            <td>Engine: <span class="underline">{{ $applicant->motor_no }}</span></td>
            <td>Chassis: <span class="underline">{{ $applicant->chassis_no }}</span></td>
        </tr>
    </table>

    <!-- Accessories Section -->
    <div class="section-title">ACCESORIES:</div>
    <table class="checkbox-table">
        <tr>
            <td><span class="checkbox-box"></span> Front Tire</td>
            <td><span class="checkbox-box"></span> Standard Muffler</td>
            <td><span class="checkbox-box"></span> Body Number</td>
        </tr>
        <tr>
            <td><span class="checkbox-box"></span> Rear Tire</td>
            <td><span class="checkbox-box"></span> Steering Bar</td>
            <td><span class="checkbox-box"></span> Garbage Receptacle</td>
        </tr>
        <tr>
            <td><span class="checkbox-box"></span> Side Mirror</td>
            <td><span class="checkbox-box"></span> Head Light</td>
            <td><span class="checkbox-box"></span> Driver's ID</td>
        </tr>
        <tr>
            <td><span class="checkbox-box"></span> Signal Light Right</td>
            <td><span class="checkbox-box"></span> Signal Light Left</td>
            <td><span class="checkbox-box"></span> Stop Light</td>
        </tr>
        <tr>
            <td><span class="checkbox-box"></span> Horn</td>
            <td><span class="checkbox-box"></span> Color Coding</td>
            <td><span class="checkbox-box"></span> Reflectorized</td>
        </tr>
        <tr>
            <td colspan="3"><span class="checkbox-box"></span> Passenger Seat Light</td>
        </tr>
    </table>

    <!-- Driver's Identification -->
    <div class="section-title">DRIVER'S IDENTIFICATION:</div>
    <div style="margin-bottom: 15px;">
        Name: <span class="underline">{{ $applicant->drivers_name }}</span> 
        with Professional Driver's License No.: <span class="underline">{{ $applicant->driver_license }}</span> 
        valid until <span class="underline">{{ $applicant->valid }}</span>
    </div>

    <!-- Remarks / Recommendation -->
    <div class="section-title">REMARKS / RECOMMENDATION:</div>
    <div style="margin-bottom: 20px;">
        <span class="checkbox-box"></span> <span class="text-bold">APPROVED</span> (Fitted for public conveyance)
        &nbsp;&nbsp;&nbsp;&nbsp;
        <span class="checkbox-box"></span> <span class="text-bold">DISAPPROVED</span> (Not fit for public conveyance)
    </div>

    <!-- Signatures Section -->
    <div class="signature-section">
        <div class="sig-block">
            <div class="text-italic text-bold">Inspected:</div>
            <br>
            <div class="text-bold">PEMS JOEY B. SANTIAGO | PCpl BRIAN L. NOMA</div>
            <div>PNP Traffic Division</div>
        </div>

        <div class="sig-block">
            <div class="text-italic text-bold">Endorsed:</div>
            <br>
            <div class="text-bold">SANNY D SABIO</div>
            <div>Chairperson, SB Committee on Transportation</div>
        </div>
    </div>

</body>
</html>