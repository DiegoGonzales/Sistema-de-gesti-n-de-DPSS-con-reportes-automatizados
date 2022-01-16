<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'device';

    //Query Scopes
    public function scopeStatus($query,$status_id){
        if($status_id){
            return $query->where('status_id', $status_id);
        }
    }
    public function scopeModel($query,$model_id){
        if($model_id){
            return $query->where('model_id', $model_id);
        }
    }
    
    public function scopeCod($query,$cod){
        $cod = "%$cod%";
        if($cod){
            return $query->where('cod', 'LIKE', $cod);
        }
    }


    public function status() {
        return $this->hasOne(DeviceStatus::class,'id','status_id');
    }

    public function model() {
        return $this->hasOne(DeviceModel::class,'id','model_id');
    }
}
