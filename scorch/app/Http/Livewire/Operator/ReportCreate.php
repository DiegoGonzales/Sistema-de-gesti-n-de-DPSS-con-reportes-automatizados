<?php

namespace App\Http\Livewire\Operator;

use App\Models\OU;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReportCreate extends Component
{
    public $currentPage = 1;
    public $selectedReportType = [];


    /*Parametros para reporte*/
    public $ou_id;
    //public $initial_date = '2021-08-17';
    //public $final_date = '2021-09-15';
    public $initial_date;
    public $final_date;

    public function nextPage($selectedReportType)
    {
        $this->selectedReportType = $selectedReportType;
        $this->currentPage++;
    }
    public function backPage()
    {
        $this->currentPage--;
    }
    public function generateReport()
    {
        $this->currentPage++;
    }

    public function getOUs()
    {
        return OU::all();
    }


    public function render()
    {
        $reportTypes = [
            [
                'id' => '1',
                'name' => 'Reporte mensual de disponibilidad total',
                'description' => '123'
            ],
            [
                'id' => '2',
                'name' => 'Reporte disponibilidad de UO',
                'description' => '123'
            ],
            [
                'id' => '3',
                'name' => 'Reporte Distribución Logística total',
                'description' => '123'
            ],
            [
                'id' => '4',
                'name' => 'Reporte Distribución Logística de UO',
                'description' => '123'
            ]
        ];

        //$r = $this->getSelectedRecord()->groupBy('weekNum');
        //dd($r);
        //dd(gettype($r));
        //echo(json_encode($r));
        
        return view('livewire.operator.report-create', [
            'reportTypes' => $reportTypes,
            'records' => $this->getSelectedRecord(),
            'allOU' => $this->getOUs()
        ])->layout('layouts.app');
        
    }

    public function getSelectedRecord()
    {
        return DB::table('avrec AS rec')
            ->leftJoin('avrec_detail AS detail', 'rec.id', '=', 'detail.avrec_id')
            ->leftJoin('device AS dev', 'detail.device_id', '=', 'dev.id')
            ->leftJoin('oper_device AS opedev', 'opedev.device_id', '=', 'detail.device_id')
            ->leftJoin('operation AS ope', 'opedev.operation_id', '=', 'ope.id')
            ->leftJoin('ou AS ou', 'ope.ou_id', '=', 'ou.id')
            ->select(DB::raw('rec.id,rec.date AS date,COUNT(detail.id) AS connections,COUNT(IF(ou.level = 0, 1, NULL)) AS ssee, COUNT(IF(ou.level > 0, 1, NULL)) AS antamina, week(rec.date) AS weekNum'))
            ->where('ope.active', '=', 1)
            ->where('opedev.active', '=', 1)
            ->whereBetween('rec.date', [$this->initial_date, $this->final_date])
            ->whereTime('rec.date', '=', '19:00:00')
            ->orderBy('rec.date')
            ->groupBy('rec.id', 'rec.date')
            ->get();
            
    }
}
