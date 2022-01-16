<?php

namespace App\Http\Livewire\Operator;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Report extends Component
{
    //->select('*')
    //->select('operation.id','oper_type.description','ou.name','operation.petitioner','device.id','device.cod','device.phone_num','device.imei','device_status.*')
    public function render()
    {
        $total = DB::table('oper_device AS operdev')
            ->leftJoin('operation AS ope', 'operdev.operation_id', '=', 'ope.id')
            ->leftJoin('oper_type AS opetype', 'ope.type_id', '=', 'opetype.id')
            ->leftJoin('ou AS ou', 'ope.ou_id', '=', 'ou.id')
            ->join('device AS dev', 'operdev.device_id', '=', 'dev.id') //inner join
            ->join('device_status AS devstat', 'dev.status_id', '=', 'devstat.id')
            ->select('ope.id AS operationID', 'opetype.description AS operationType', 'ou.name AS ouName', 'ope.petitioner AS operationPetitioner', 'dev.id AS deviceId', 'dev.cod AS deviceCod', 'dev.phone_num AS devicePhone', 'dev.imei as deviceImei', 'dev.status_id AS deviceStatusID', 'devstat.cod AS deviceStatus', 'devstat.description AS deviceStatusDesc')
            ->where('ope.active', '=', 1)
            ->where('operdev.active', '=', 1)
            ->get();

        $qxStatuses = DB::table('oper_device AS operdev')
            ->leftJoin('operation AS ope', 'operdev.operation_id', '=', 'ope.id')
            ->leftJoin('oper_type AS opetype', 'ope.type_id', '=', 'opetype.id')
            ->leftJoin('ou AS ou', 'ope.ou_id', '=', 'ou.id')
            ->join('device AS dev', 'operdev.device_id', '=', 'dev.id') //inner join
            ->join('device_status AS devstat', 'dev.status_id', '=', 'devstat.id')
            ->select(DB::raw('devstat.cod,devstat.description,count(devstat.cod) AS total'))
            ->groupBy('devstat.cod', 'devstat.description')
            ->where('ope.active', '=', 1)
            ->where('operdev.active', '=', 1)
            ->get();

        $dvcsXou = DB::table('oper_device AS operdev')
            ->leftJoin('operation AS ope', 'operdev.operation_id', '=', 'ope.id')
            ->leftJoin('oper_type AS opetype', 'ope.type_id', '=', 'opetype.id')
            ->leftJoin('ou AS ou', 'ope.ou_id', '=', 'ou.id')
            ->join('device AS dev', 'operdev.device_id', '=', 'dev.id') //inner join
            ->join('device_status AS devstat', 'dev.status_id', '=', 'devstat.id')
            ->select(DB::raw('ou.name AS ouName,COUNT(IF(devstat.cod = "ENT", 1, NULL)) AS ouENT, COUNT(IF(devstat.cod = "BPR", 1, NULL)) AS ouBPR, COUNT(IF(devstat.cod = "BDP", 1, NULL)) AS ouBDP, COUNT(IF(devstat.cod = "SAG", 1, NULL)) AS ouSAG'))
            ->groupBy('ou.name')
            ->where('ope.active', '=', 1)
            ->where('operdev.active', '=', 1)
            ->get();

        return view('livewire.operator.report', ['total' => $total, 'qxStatuses' => $qxStatuses, 'dvcsXou' => $dvcsXou])->layout('layouts.app');
    }
    //
}
