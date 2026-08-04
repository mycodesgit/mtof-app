<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Affidavit of Undertaking</title>
    <style>
        @page {
            margin: 50px 60px;
        }
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #000;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-bold {
            font-weight: bold;
        }
        .underline {
            text-decoration: underline;
            font-weight: bold;
        }
        
        /* Header / Venue Section */
        .venue-section {
            margin-bottom: 25px;
        }
        
        /* Main Title */
        .doc-title {
            font-size: 15pt;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        /* Content Body */
        .content {
            text-align: justify;
            margin-bottom: 15px;
        }
        ol {
            padding-left: 30px;
            margin-top: 5px;
        }
        li {
            margin-bottom: 12px;
            text-align: justify;
        }

        /* Vehicle Details Block */
        .specs-block {
            margin: 10px 0 10px 30px;
        }
        .specs-block div {
            margin-bottom: 3px;
        }

        /* Signatures Section */
        .signature-block {
            margin-top: 30px;
            float: right;
            width: 300px;
            text-align: center;
        }

        .clear {
            clear: both;
        }

        /* Notary / Jurat Section */
        .jurat-section {
            margin-top: 40px;
            text-align: justify;
        }
        .fill-line {
            display: inline-block;
            border-bottom: 1px solid #000;
            min-width: 200px;
        }
    </style>
</head>
<body>

    <!-- Legal Header / Jurisdiction -->
    <div class="venue-section">
        REPUBLIC OF THE PHILIPPINES)<br>
        <span style="display: inline-block; min-width: 220px; border-bottom: 1px solid #000;"></span>) S.S.<br>
        X-------------------------------------------X
    </div>

    <!-- Document Title -->
    <div class="doc-title">
        AFFIDAVIT OF UNDERTAKING
    </div>

    <!-- Preamble -->
    <div class="content" style="text-indent: 40px;">
        I, <span class="underline">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }}</span>, Filipino of legal age, {{ $applicant->civil_status ?? 'single/married/widow/widower' }}, and a resident of Barangay <span class="underline">{{ $applicant->brgy }}</span>, Negros Occidental, after having duly sworn to according to law hereby depose and say:
    </div>

    <!-- Numbered Declarations -->
    <ol>
        <li>
            That, I am the owner of a motorcycle with/without sidecar with the following particulars:
            <div class="specs-block">
                <div>Engine No.: <span class="underline">{{ $applicant->motor_no }}</span></div>
                <div>Chassis No.: <span class="underline">{{ $applicant->chassis_no }}</span></div>
                <div>Plate No.: <span class="underline">{{ $applicant->plate_no }}</span></div>
                <div>CR No.: <span class="underline">{{ $applicant->cr_no }}</span></div>
            </div>
        </li>
        <li>
            That, I intend to reclassify or change the denomination of my above-described motorcycle from <strong>"Private"</strong> to <strong>"For Hire"</strong> before validation of my Motorized Tricycle Operator's Franchise (MTOF);
        </li>
        <li>
            That, I am executing this affidavit as part of the requirements for the grant of my MTOF; and
        </li>
        <li>
            That, I am executing this affidavit to attest to the truth of the foregoing statements and for whatever legal purpose it may serve.
        </li>
    </ol>

    <!-- Execution Statement -->
    <div class="content" style="margin-top: 25px; text-indent: 40px;">
        <strong>IN WITNESS WHEREOF</strong>, I hereby set my hand this <span style="display: inline-block; min-width: 250px; border-bottom: 1px solid #000;"></span> at Candoni, Negros Occidental, Philippines.
    </div>

    <!-- Affiant Signature Block -->
    <div class="signature-block">
        <div class="underline" style="font-size: 12pt;">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }}</div>
        <div>(Signature over printed name)</div>
        <div>Affiant</div>
        <br>
        <div>ID No/TIN: <span class="underline">{{ $applicant->tin_no }}</span></div>
    </div>

    <div class="clear"></div>

    <!-- Jurat / Notary Section -->
    <div class="jurat-section">
        <strong>SUBSCRIBED AND SWORN</strong> to before me this <span style="display: inline-block; min-width: 220px; border-bottom: 1px solid #000;"></span> at <span style="display: inline-block; min-width: 300px; border-bottom: 1px solid #000;"></span>, Negros Occidental, Philippines.
    </div>

</body>
</html>