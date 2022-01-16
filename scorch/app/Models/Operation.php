<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $table = 'operation';

    protected $fillable = [
        'petitioner', 'supervisor','deliveredby','comment','operation_date','active','type_id','ou_id'
    ];

    public function type() {
        return $this->hasOne(OperationType::class,'id','type_id');
    }

    public function ou() {
        return $this->hasOne(OU::class,'id','ou_id');
    }
}
