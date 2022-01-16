<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationDevice extends Model
{
    use HasFactory;
    protected $table = 'oper_device';

    protected $fillable = [
        'device_id', 'operation_id','device_user_id','active'
    ];

    public function device() {
        return $this->hasOne(Device::class,'id','device_id');
    }

}
