<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRecord extends Model
{
    use HasFactory;
    protected $table = 'avrec';
    protected $fillable = [
        'date','inactives','assessments','active'
    ];
}
