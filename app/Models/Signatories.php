<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatories extends Model
{
    use HasFactory;

    protected $fillable = [
        'sigfname',
        'sigmname',
        'siglname',
        'sigposition',
        'postedBy',
        'status'
    ];
}
