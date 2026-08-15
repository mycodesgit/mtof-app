<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantDocs extends Model
{
    use HasFactory;
    protected $table = 'applicantdocs';

    protected $fillable = [
        'appID',
        'docID',
        'postedBy',
    ];

    /**
     * Get the applicant that owns the document record.
     */
    public function applicant()
    {
        return $this->belongsTo(Applicants::class, 'appID');
    }

    /**
     * Get the document details.
     */
    public function document()
    {
        return $this->belongsTo(Document::class, 'docID');
    }
}
