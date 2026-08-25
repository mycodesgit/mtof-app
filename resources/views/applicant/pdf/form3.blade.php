<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TRU Form 3: Franchise Form</title>
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
        
        /* Top Header */
        .sub-header {
            font-size: 10pt;
            margin-bottom: 10px;
        }
        .header-table {
            width: 100%;
            margin-bottom: 15px;
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

        /* Document Title */
        .doc-title {
            font-size: 16pt;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        /* Content Paragraphs */
        .content {
            text-align: center;
            margin-bottom: 15px;
        }

        /* MTOF Table Box */
        .mtof-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0 20px 0;
        }
        .mtof-table th {
            border: 1px solid #ccc;
            font-size: 8pt;
            font-weight: bold;
            padding: 4px;
            text-align: center;
            background-color: #fff;
            color: #444;
        }
        .mtof-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
        }

        /* Specs Table */
        .specs-table {
            width: 100%;
            margin: 15px 0 20px 0;
            border-collapse: collapse;
        }
        .specs-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        /* Signatures Section */
        .signatures-table {
            width: 100%;
            margin-top: 30px;
        }
        .signatures-table td {
            width: 50%;
            vertical-align: top;
        }
        
        .attested-section {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Sub Header -->
    <div class="sub-header text-italic">
        TRU Form 3: Franchise Form
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
                <div class="header-title-3">Office of the Sangguniang Bayan</div>
                <div>------ooOoo------</div>
            </td>
        </tr>
    </table>

    <!-- Title -->
    <div class="doc-title text-center">
        Motorized Tricycle Operator's Franchise
    </div>

    <!-- Preamble -->
    <div class="content">
        With the evidences submitted before the Sangguniang Bayan, and, as the requirements set in<br>
        the grant of the Motorized Tricycle Operator’s Franchise (MTOF) had been complied;
    </div>

    <div class="content">
        By virtues of the Section 7 of Municipal Ordinance 2021-001,<br>
        the application for a MTOF of<br>
        <span class="underline" style="font-size: 12pt;">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }}</span><br>
        is hereby APPROVED
    </div>

    <!-- MTOF Details Table -->
    <table class="mtof-table">
        <thead>
            <tr>
                <th style="width: 33.33%;">MTOF NUMBER</th>
                <th style="width: 33.33%;">DATE ISSUED</th>
                <th style="width: 33.33%;">DATE EXPIRE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $applicant->mtof_no ?? '4412' }}</td>
                <td>{{ $applicant->date_issued ?? '2021-02-13' }}</td>
                <td>{{ $applicant->date_expire ?? '2021-02-19' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Terms -->
    <div class="content" style="text-align: justify; margin-bottom: 15px;">
        This MTOF subjects the holder to the provisions of Municipal Ordinance No. 2021-001, and all Ordinance, Resolutions, Issuances and the like, that the Sangguniang Bayan of Candoni heretofore enact, adopt or issue relative to tricycle franchising and operations.
    </div>

    <div class="content">
        The holder shall confine his/her operations to the following authorized tricycle route/zone:
    </div>

    <div class="text-center underline" style="font-size: 12pt; margin-bottom: 15px;">
        {{ $applicant->brgy }}
    </div>

    <div class="content">
        with the use of one (1) unit tricycle, with motor component described hereunder to wit
    </div>

    <!-- Vehicle Details -->
    <table class="specs-table">
        <tr>
            <td style="width: 33%;">Make: <span class="underline">{{ $applicant->mtof_make }}</span></td>
            <td style="width: 33%;">Color: <span class="underline">{{ $applicant->mtof_color }}</span></td>
            <td style="width: 34%;">CC: <span class="underline">{{ $applicant->mtof_cc }}</span></td>
        </tr>
        <tr>
            <td>Engine: <span class="underline">{{ $applicant->motor_no }}</span></td>
            <td>Chassis: <span class="underline">{{ $applicant->chassis_no }}</span></td>
            <td>Plate No.: <span class="underline">{{ $applicant->plate_no }}</span></td>
        </tr>
    </table>

    <!-- Legal Disclaimer -->
    <div class="content" style="text-align: justify; margin-top: 20px;">
        Nothing herein shall be construed as limiting the power of the Land Transportation Office in the registration of motor vehicle and in the enforcement to transport rules. The MTOF is subject to the ratification by the Sangguniang Bayan.
    </div>

    <!-- Signatures -->
    <table class="signatures-table">
        <tr>
            <td style="text-align: left;">
                <div class="text-italic">Recommending Approval:</div>
                <br><br>
                @if(isset($signatories['Recommending Approval']))
                    <div class="text-bold">{{ strtoupper(trim("{$signatories['Recommending Approval']->sigfname} {$signatories['Recommending Approval']->sigmname} {$signatories['Recommending Approval']->siglname} {$signatories['Recommending Approval']->sigext}")) }}</div>
                    <div>{{ $signatories['Recommending Approval']->position_name ?? 'Chairperson, Committee on Transportation' }}</div>
                @else
                    <div>Chairperson, Committee on Transportation</div>
                @endif
            </td>
            <td style="text-align: right;">
                <div class="text-italic" style="padding-right: 50px;">Approved:</div>
                <br><br>
                @if(isset($signatories['Approved']))
                    <div class="text-bold">{{ strtoupper(trim("{$signatories['Approved']->sigfname} {$signatories['Approved']->sigmname} {$signatories['Approved']->siglname} {$signatories['Approved']->sigext}")) }}</div>
                    <div>{{ $signatories['Approved']->position_name ?? 'Vice Mayor/Presiding Officer' }}</div>
                @else
                    <div>Vice Mayor/Presiding Officer</div>
                @endif
            </td>
        </tr>
    </table>

    <!-- Attested Section -->
    <div class="attested-section">
        <div class="text-italic">Attested:</div>
        <br><br>
        @if(isset($signatories['Attested']))
            <div class="text-bold">{{ strtoupper(trim("{$signatories['Attested']->sigfname} {$signatories['Attested']->sigmname} {$signatories['Attested']->siglname} {$signatories['Attested']->sigext}")) }}</div>
            <div>{{ $signatories['Attested']->position_name ?? 'Secretary to the Sangguniang Bayan' }}</div>
        @else
            <div>Secretary to the Sangguniang Bayan</div>
        @endif
    </div>

</body>
</html>