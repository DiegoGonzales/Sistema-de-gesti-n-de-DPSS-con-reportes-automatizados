<?php

namespace App\Http\Livewire\Operator\Report;

use App\Models\OU;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TotalDistribution extends Component
{
    public function render()
    {
        return view('livewire.operator.report.total-distribution', [
            'allOU' => $this->getOUs(),
            'quantity' => $this->getQuantities()
        ])->layout('layouts.app');
    }
    public function getOUs()
    {
        return OU::all();
    }
    public function getQuantities()
    {
        return DB::table('oper_device AS operdev')
            ->leftJoin('operation AS ope', 'operdev.operation_id', '=', 'ope.id')
            ->leftJoin('oper_type AS opetype', 'ope.type_id', '=', 'opetype.id')
            ->leftJoin('ou AS ou', 'ope.ou_id', '=', 'ou.id')
            ->join('device AS dev', 'operdev.device_id', '=', 'dev.id') //inner join
            ->join('device_status AS devstat', 'dev.status_id', '=', 'devstat.id')
            ->select(DB::raw('ou.id as ouID, ou.name AS ouName,COUNT(IF(devstat.cod = "ENT", 1, NULL)) AS ouENT, COUNT(IF(devstat.cod = "BPR", 1, NULL)) AS ouBPR, COUNT(IF(devstat.cod = "BDP", 1, NULL)) AS ouBDP, COUNT(IF(devstat.cod = "SAG", 1, NULL)) AS ouSAG'))
            ->groupBy('ou.name', 'ou.id')
            ->where('ope.active', '=', 1)
            ->where('operdev.active', '=', 1)
            ->get();
    }

    public function getOuDeviceQuantity(){
        //llame a la table ou 

        /* Si esta otras OU que lo tiene como master_ou, contar los dispositivos de cada ou y sumarlos y esa es su cantidad
        Si no busca cuantos operdevices tiene asignado
        esto por cada ou 
        
        de retorno un variable con ou.id,ou.level,ou.name. cantidad de dispostiviso ENT BPR BPD SAG */
        
    }
}
