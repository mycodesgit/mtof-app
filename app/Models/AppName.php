<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppName extends Model
{
    use HasFactory;

    protected $table = 'appname';

    protected $fillable = [
        'application_headername',
        'application_fullname',
        'application_desc',
        'application_about',
        'application_category',
        'application_email',
        'application_contactno'
    ];
}
