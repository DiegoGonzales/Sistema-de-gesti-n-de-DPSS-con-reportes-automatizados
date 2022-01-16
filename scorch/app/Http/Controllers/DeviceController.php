<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function index(){
        return view('devices.index');
    }
    //public function show($device){
        
    public function show(Device $device){

        $history =  DB::table('device AS dev')
            ->leftJoin('oper_device AS opedev', 'opedev.device_id', '=', 'dev.id')
            ->leftJoin('operation AS ope', 'ope.id', '=', 'opedev.operation_id')
            ->leftJoin('ou AS ou', 'ou.id', '=', 'ope.ou_id')
            ->leftJoin('oper_type AS opetype', 'opetype.id', '=', 'ope.type_id')
            ->select('dev.id AS devID','dev.cod AS devCod','dev.phone_num AS devPhone','dev.imei as devImei','ope.id AS opeID','ope.operation_date AS opeDate','opetype.id AS opeTypeID','opetype.name AS opeType','ou.id AS ouID','ou.name as ouName','ope.petitioner AS opePetitioner','ope.supervisor AS opeSupervisor','ope.deliveredby AS opeDeliveredby','ope.comment AS opeComment','opedev.active AS opeStatus')
            ->where('dev.id','=',$device->id)
            ->orderBy('ope.operation_date', 'desc')
            ->get()
            ->toArray();
        

        return view('devices.show',compact('device','history'));
    }

  
}
