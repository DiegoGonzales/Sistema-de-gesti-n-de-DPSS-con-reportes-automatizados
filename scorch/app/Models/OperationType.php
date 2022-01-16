<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationType extends Model
{
    use HasFactory;

    protected $table = 'oper_type';
    protected $fillable = [
        'name','description', 'origin_status_id', 'destiny_status_id'
    ];
}
