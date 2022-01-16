<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRecordDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'avrec_detail';
    protected $fillable = [
        'avrec_id','device_id','ou_id'
    ];
}
