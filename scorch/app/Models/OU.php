<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OU extends Model
{
    use HasFactory;

    protected $table = 'ou';

    protected $fillable = [
        'name', 'ruc', 'level','master_ou','status',
    ];



    public function master(){
        return $this->belongsTo(OU::class, 'master_ou', 'id');
    }
    public function child(){
        return $this->hasMany(OU::class, 'master_ou', 'id');
    }
    /*
        Como no es un modelo se accede al array que si esta llegando{{$master['name']}}  
    */
}

