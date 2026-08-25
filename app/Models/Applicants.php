<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'ext',
        'brgy',
        'tin_no',

        // Vehicle Information
        'mtof_make',
        'mtof_color',
        'mtof_cc',
        'motor_no',
        'chassis_no',
        'plate_no',
        'body_no',
        'route_no',
        'color_code',

        // Registration Details
        'cr_no',
        'or_no',
        'or_date',
        'date_acq',
        'valid',

        // Driver Information
        'drivers_name',
        'driver_license',

        // Other Details
        'mtof_id',
        'p_name',

        // Status
        'status',
        'status1',
        'delstat',

        // Dates
        'date_issued',
        'date_expired',
    ];

    protected $casts = [
        //'or_date'       => 'date',
        //'date_acq'      => 'date',
        //'valid'         => 'date',
        'date_issued'   => 'date',
        //'date_expired'  => 'date',
    ];
}
