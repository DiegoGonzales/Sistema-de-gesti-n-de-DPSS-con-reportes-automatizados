<?php

namespace App\Http\Livewire\Operator;

use App\Models\AvailabilityRecord;
use App\Models\OU;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;



class AvailabilityShow extends Component

{
    use WithPagination;

    public $record;
    public $devCode, $devOU;


    public function mount(AvailabilityRecord $record)
    {
        $this->record = $record;

    }


    //Comparar si el ouChild es parte del ouParent listo
    //almacenar los entregados del ouChild en una variable y asignarla al ouParent
    /*function detectOuChildsOriginal($data, $parentOUID)
    {
        $order = array();

        foreach ($data as $item) {

            //Verificar que el ou pertenezca al ouParent
            if ($item['ouMasterID'] == $parentOUID) {
                $children = $this->detectOuChildsOriginal($data, $item['ouID']);

                $children['ouID'] = $item['ouID'];
                $children['ouName'] = $item['ouName'];
                $children['ouEnt'] = $item['ouEnt'];
                $order[] = $children;
            }
        }

        return $order;
    }*/

    function sumAll($test)
    {
        $sum = 0;
        //Grupo de OUs correspondientes de la OU mayor
        $test = new RecursiveIteratorIterator(new RecursiveArrayIterator($test));
        //Key es el valor por el cual quieres iterar 
        foreach ($test as $key => $value) {
            if ($key == 'ouEnt') {
                $sum += $value;
            }
        }
        //OJO! Aca solo llega una suma total 
        return $sum;
    }

    function sumAllConnections($test)
    {
        $conns = 0;
        //Grupo de OUs correspondientes de la OU mayor
        $test = new RecursiveIteratorIterator(new RecursiveArrayIterator($test));
        //Key es el valor por el cual quieres iterar 
        foreach ($test as $key => $value) {
            if ($key == 'ouConns') {
                $conns += $value;
            }
        }
        //OJO! Aca solo llega una suma total 
        return $conns;
    }

    function addGroupData($totalOU, $groupInfo)
    {
        //Agregando Antamina General como un OU al 
        $totalQty = 0;
        $totalConns = 0;
        foreach ($totalOU as $item) {
            if ($item['ouLvl'] == $groupInfo['groupLvl']) {
                $totalQty += $item['ouQuantity'];
                $totalConns += $item['ouConnections'];
            }
        }
        $totalPrcnt = (100 * $totalConns) / $totalQty;
        $groupData = [
            'groupName' => $groupInfo['groupName'],
            'groupQty' => $totalQty,
            'groupConns' => $totalConns,
            'groupPrcnt' => number_format($totalPrcnt, 2, '.', ' ')
        ];
        return $groupData;
    }


    //esta funcion hace un match entre los dos arrays de cantidades y conexiones que esta llegando segun el id del OU de manera bruta sin orden jerarquico es decir como llegan las OU de la bd
    function identifyQuantities($allOUs, $quantities, $allConnDvcs)
    {
        foreach ($allOUs as $ou) {
            //Cantidad de devices asignados
            $q = 0;
            //Haciendo match clave principal ouID 
            foreach ($quantities as $quantity) {
                if ($quantity->ouID == $ou->id) {
                    $q = $quantity->ouEnt;
                }
            }

            //Calculando los activos por OU
            $connDvcs = 0;
            foreach ($allConnDvcs as $connDev) {
                # por cada ConnectedDevice
                if ($connDev->ouID == $ou->id) {
                    $connDvcs++;
                }
            }

            //porcetanje
            if ($q != 0) {
                $percentage = (100 * $connDvcs) / $q;
            } else {
                $percentage = 0.00;
            }




            //Se crea un array de cada OU que tienen las cantidades por OU pero sin sumarlas jerarquicamente
            $ouResume = [
                'ouID' => $ou->id,
                'ouName' => $ou->name,
                'ouLvl' => $ou->level,
                'ouMasterID' => $ou->master_ou,
                'ouQuantity' => $q,
                'ouConnections' => $connDvcs,
                'ouPercentage' => number_format($percentage, 2, '.', ' ')
            ];

            $ousResume[] = $ouResume;
        }
        return $ousResume;
    }



    //Aquí es una función que se iterara por cada ou para ver si tiene childs o no creara por cada ou un array multidimensional de sus childs
    //-Vicepresidencia
    //--Sus gerencias
    //---Sus superintendencias para que luego las cantidades se sumen en una función
    function detectOuChilds($data, $parentOUID)
    {
        $ouChilds = array();

        foreach ($data as $item) {

            //Verificar que el ou pertenezca al ouParent
            if ($item['ouMasterID'] == $parentOUID) {
                $child = $this->detectOuChilds($data, $item['ouID']);

                $child['ouID'] = $item['ouID'];
                $child['ouName'] = $item['ouName'];
                $child['ouEnt'] = $item['ouQuantity'];
                $child['ouConns'] = $item['ouConnections'];
                $ouChilds[] = $child;
            }
        }

        return $ouChilds;
    }



    public function render()
    {
        //Paso 1 -
        //Obtenemos solo las OU(allOus)
        $allOUs = $this->getOUs();
        //Paso 2 -
        //Obtenemos las cantidades entregadas a cada Ou en un objeto($quantitiesPerOu)
        $quantities = $this->getQuantities('2019-03-25', $this->record->date); //Obtenemos cantidad de equipos entregados por todas las OU
        //dd($quantities);
        $connections = $this->getRecordDetail();

        //Paso 3 -
        //Hacemos un match entre $allOus y $ouResume como clave principal ouID
        $ousResume = $this->identifyQuantities($allOUs, $quantities, $connections);
        //dd($ousResume);
        //Paso 4 -
        //Entra la funcion de detectOuChilds() donde se ubica a las OUs correspondientes cada OU segun su orden jerarquico
        //Se crea un array multidimensional llamado ouChilds


        foreach ($ousResume as $ouResume) {
            //Detecto si tiene hijos
            //Solo sirve para ver el total de la ouParent
            $ouChilds = $this->detectOuChilds($ousResume, $ouResume['ouID']);
            
            
            //Suma todos los entregados de los OuChilds
            $total = $this->sumAll($ouChilds);
            //Sumar todos los conectados
            $totalConns = $this->sumAllConnections($ouChilds);

            if ($total == 0 && $totalConns == 0) {
                //do nothing
            } else {
                //Asignando a un nuevo array-multidimensional los nuevas cifras totales
                $ouResume['ouQuantity'] = $total;
                $ouResume['ouConnections'] = $totalConns;
                $percentage = (100 * $totalConns) / $total;
                $ouResume['ouPercentage'] = number_format($percentage, 2, '.', ' ');
            }


            $totalOU[] = $ouResume;
            //$ouParents[$ouResume['ouName']] = $total;
            //COndicion si la suma da cero pues mantente con tus entregados normales si no asignale

        }
        //dd($totalOU);


        //Un array con un nombre, lvl
        //$groupInfo (groupName,groupLvl,groupMaster)
        $groupInfo = [
            [
                'groupName' => 'Antamina',
                'groupLvl' => 1,
                'groupMaster' => null
            ],
            [
                'groupName' => 'SSEE',
                'groupLvl' => 0,
                'groupMaster' => null
            ],
        ];


        //Total Antamina y SSEE
        foreach ($groupInfo as $group) {
            $groupData = $this->addGroupData($totalOU, $group);
            $ouGroups[] = $groupData;
        }




        $qxStatus = $this->getDevicesXStatus();
        //dd($qxStatus);
        $totalDistribuidos = 0;
        $totalAsignados = 0;
        foreach ($qxStatus as $status) {
            $totalAsignados += $status->count;
            if ($status->code == 'ENT') {
                $totalDistribuidos = $status->count;
            }
        }
        
        //ResumenLogisticoCantidades
        /*
        $totalTodayConns = 0;
        foreach ($ouGroups as $ouGroup) {
            $totalTodayConns += $ouGroup['groupConns'];
        }*/

        //dd($totalTodayConns);
        /*
        $groupTotalAsignados = [
            'groupName' => 'Total Asignados al Proyecto',
            'groupQty' => $totalAsignados,
            'groupConns' => $totalActivos,
            'groupPrcnt' => 0
        ];*/
        $week = $this->getWeekRecord();
        //OJO! solamente tienen los activos de esa semana mas no la distribución por cada uno de esos dias
        //dd($week);
        /*
        +"id": 5
        +"date": "2021-08-17 19:00:00"
        +"connections": 105*/
  
        //distribuidos
        //activos X 
        //no activos 
        //disponibilidad %
        //reportes procesador por dia
        foreach ($week as $day) {

            $dist = $this->getDistributionTotalCountByGivenDate('2019-03-25', $day->date);
            $distTotal = $dist[0]->totalEnt;
            //dd( $dist);
            $disconnected = $distTotal - $day->connections;

            if ($distTotal != 0) {
                $percentage = (100 * $day->connections) / $distTotal;
            } else {
                $percentage = 0.00;
            }

            $day = [
                'id' => $day->id,
                'date' => $day->date,
                'distributed' => $distTotal,
                'connected' => $day->connections,
                'disconnected' => $disconnected,
                'antamina' => $day->antamina,
                'ssee' => $day->ssee,
                'percentage' => number_format($percentage, 2, '.', ' ')
            ];
            $weekRecords[] = $day;
        }

        


        //dd($weekRecords);


        return view('livewire.operator.availability-show', [
            'totalOU' => $totalOU,
            'weekRecords'  => $weekRecords,
            'totalAsignados' => $totalAsignados,
            'qxStatus' => $this->getDevicesXStatus(),
            'allOU' => $this->getOUs()
        ])->layout('layouts.app');
    }

    public function getOUs()
    {
        return OU::all();
    }


    public function  getQuantities($inital, $final)
    {
        return DB::select("CALL SP_GetDistributionPerOuCountByGivenDate('$inital','$final')");
        /*
        return DB::table('oper_device AS operdev')
            ->leftJoin('operation AS ope', 'operdev.operation_id', '=', 'ope.id')
            ->leftJoin('oper_type AS opetype', 'ope.type_id', '=', 'opetype.id')
            ->leftJoin('ou AS ou', 'ope.ou_id', '=', 'ou.id')
            ->join('device AS dev', 'operdev.device_id', '=', 'dev.id') //inner join
            ->join('device_status AS devstat', 'dev.status_id', '=', 'devstat.id')
            ->select(DB::raw('ou.id as ouID, ou.level AS ouLvl,ou.master_ou AS ouMaster,ou.name AS ouName,COUNT(IF(devstat.cod = "ENT", 1, NULL)) AS ouENT'))
            ->groupBy('ou.name', 'ou.id', 'ou.level', 'ou.master_ou')
            ->where('ope.active', '=', 1)
            ->where('operdev.active', '=', 1)
            ->get();*/
    }

    public function getDevicesXStatus()
    {
        return DB::table('device AS dev')
            ->leftJoin('device_status AS devstat', 'dev.status_id', '=', 'devstat.id')
            ->select(DB::raw('devstat.cod AS code, devstat.description AS description, COUNT(dev.cod) AS count'))
            ->groupBy('devstat.cod', 'devstat.description')
            ->get()
            ->toArray();
    }


    public function getRecordDetail()
    {
        return DB::table('avrec_detail AS avd')
            ->leftJoin('ou AS ou', 'avd.ou_id', '=', 'ou.id')
            ->join('device AS dev', 'avd.device_id', '=', 'dev.id') //inner join
            ->select('dev.cod AS devCode', 'ou.id AS ouID', 'ou.name AS devOU', 'ou.master_ou AS ouMaster')
            ->where('avd.avrec_id', '=', $this->record->id)
            ->get();
    }

    public function getWeekRecord()
    {

        return DB::table('avrec AS rec')
            ->leftJoin('avrec_detail AS detail', 'rec.id', '=', 'detail.avrec_id')
            ->leftJoin('device AS dev', 'detail.device_id', '=', 'dev.id')
            ->leftJoin('oper_device AS opedev', 'opedev.device_id', '=', 'detail.device_id')
            ->leftJoin('operation AS ope', 'opedev.operation_id', '=', 'ope.id')
            ->leftJoin('ou AS ou', 'ope.ou_id', '=', 'ou.id')
            ->select(DB::raw('rec.id,rec.date,COUNT(detail.id) AS connections,COUNT(IF(ou.level = 0, 1, NULL)) AS ssee, COUNT(IF(ou.level > 0, 1, NULL)) AS antamina'))
            ->where('ope.active', '=', 1)
            ->where('opedev.active', '=', 1)
            ->where('rec.date', '>=', $this->record->date)
            ->orderBy('rec.date')
            ->groupBy('rec.id', 'rec.date')
            ->limit(7)
            ->get();
    }

    public function getDistributionTotalCountByGivenDate($inital, $final)
    {
        return DB::select("CALL SP_GetDistributionTotalCountByGivenDate('$inital','$final')");
    }
}
