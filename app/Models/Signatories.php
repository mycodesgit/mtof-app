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
        'sigext',
        'sigposition',
        'postedBy',
        'status'
    ];
    
    protected $appends = ['position_name'];

    public function position()
    {
        return $this->belongsTo(Positions::class, 'sigposition');
    }

    public function getPositionNameAttribute()
    {
        return $this->position ? $this->position->name : null;
    }
}
