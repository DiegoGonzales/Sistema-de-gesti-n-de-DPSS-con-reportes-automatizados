<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OU;
use Hamcrest\Core\IsCollectionContaining;
use Hamcrest\Type\IsObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class ReportController extends Controller
{/*
    public $initial_date = '2020-08-10';
    public $final_date = '2020-08-15';
    
    public $initial_date;
    public $final_date;
*/
    public function create()
    {
        return view('operator.report.create');
    }

    public function getWeekRecordsByGivenDate($inital, $final)
    {
        return DB::select("CALL SP_getWeekRecordsByGivenDate('$inital','$final')");
    }
    public function getDistribution($inital, $final)
    {
        return DB::select("CALL SP_GetDistributionGeneralCountByGivenDate('$inital','$final')");
    }
    public function getDistributionPerOu($inital, $final)
    {
        return DB::select("CALL SP_GetDistributionPerOuCountByGivenDate('$inital','$final')");
    }
    public function getOperationsByGivenDates($inital, $final)
    {
        return DB::select("CALL SP_GetOperationsByGivenDates('$inital','$final')");
    }
    public function getOperationsByOUGivenDates($inital, $final, $ou_id)
    {
        return DB::select("CALL SP_GetOperationsByOUGivenDates('$inital','$final','$ou_id')");
    }
    public function getOperationsDetailByGivenDates($inital, $final)
    {
        return DB::select("CALL SP_GetOperationsDetailByGivenDates('$inital','$final')");
    }
    public function getOUs()
    {
        return OU::all();
    }
    /*Reporte por OU*/
    public function getAvailabilityByOu($inital, $final, $ou_id)
    {
        return DB::select("CALL SP_GetAvailabilityByOu('$inital','$final','$ou_id')");
    }
    public function getDistributionByOu($final, $ou_id)
    {
        return DB::select("CALL SP_GetDistributionByOu('$final','$ou_id')");
    }

    public function getRecordListDetail($rec_id)
    {
        return DB::select("CALL SP_GetRecordListDetail('$rec_id')");
    }

    //esta funcion hace un match entre los dos arrays de cantidades y conexiones que esta llegando segun el id del OU de manera bruta sin orden jerarquico es decir como llegan las OU de la bd
    function identifyQuantities($allOUs, $quantities)
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
            //Se crea un array de cada OU que tienen las cantidades por OU pero sin sumarlas jerarquicamente
            $ouResume = [
                'ouID' => $ou->id,
                'ouName' => $ou->name,
                'ouLvl' => $ou->level,
                'ouMasterID' => $ou->master_ou,
                'ouQuantity' => $q,
            ];

            $ousResume[] = $ouResume;
        }
        return $ousResume;
    }

    function matchQuantitiesBySingle($ouGroup, $quantities, $conns)
    {
        foreach ($ouGroup as $ou) {
            //Cantidad de devices asignados
            $q = 0;
            //Haciendo match clave principal ouID 
            foreach ($quantities as $quantity) {
                if ($quantity->ouID == $ou['ouID']) {
                    $q = $quantity->ouEnt;
                }
            }
            //Cantidad de devices conectados
            $c = 0;
            //Haciendo match clave principal ouID 
            foreach ($conns as $conn) {
                if ($conn->ouID == $ou['ouID']) {
                    $c = $conn->ouConns;
                }
            }
            //Se crea un array de cada OU que tienen las cantidades por OU pero sin sumarlas jerarquicamente
            $ouResume = [
                'ouID' => $ou['ouID'],
                'ouName' => $ou['ouName'],
                'ouMasterID' =>  $ou['ouMasterOU'],
                'ouEnt' => $q,
                'ouConns' => $c,
            ];

            $ousResume[] = $ouResume;
        }
        return $ousResume;
    }


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
                $ouChilds[] = $child;
            }
        }

        return $ouChilds;
    }

    function detectOuChilds2($data, $parentOUID)
    {
        $ouChilds = array();

        foreach ($data as $item) {

            //Verificar que el ou pertenezca al ouParent
            if ($item['ouMasterID'] == $parentOUID) {
                $child = $this->detectOuChilds2($data, $item['ouID']);
                $child['ouID'] = $item['ouID'];
                $child['ouName'] = $item['ouName'];
                $child['ouEnt'] = $item['ouEnt'];
                $child['ouConns'] = $item['ouConns'];
                $ouChilds[] = $child;
            }
        }

        return $ouChilds;
    }

    function detectOuChilds3($data, $parentOUID)
    {
        $ouChilds = array();

        foreach ($data as $item) {

            //Verificar que el ou pertenezca al ouParent
            if ($item['ouMasterOU'] == $parentOUID) {
                $child = $this->detectOuChilds3($data, $item['ouID']);
                $child['ouID'] = $item['ouID'];
                $child['ouName'] = $item['ouName'];
                $child['ouEnt'] = $item['ouQuantity'];
                $ouChilds[] = $child;
            }
        }

        return $ouChilds;
    }


    function detectOuChildsBySingle($ous, $parentOUID)
    {
        $ouChilds = array();

        foreach ($ous as $ou) {

            //Verificar que el ou pertenezca al ouParent
            if ($ou->master_ou == $parentOUID) {
                $child = $this->detectOuChildsBySingle($ous, $ou->id);

                $child['ouID'] = $ou->id;
                $ouChilds[] = $child;
            }
        }

        return $ouChilds;
    }
    function extractOuID($test)
    {
        $list = array();
        //Grupo de OUs correspondientes de la OU mayor
        $test = new RecursiveIteratorIterator(new RecursiveArrayIterator($test));
        //Key es el valor por el cual quieres iterar 
        foreach ($test as $key => $value) {
            if ($key == 'ouID') {
                $id = $value;
                $list[] = $id;
            }
        }
        //OJO! Aca solo llega una suma total 
        return $list;
    }

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


    /*Reporte mensual de disponibilidad total*/
    public function generated(Request $request)
    {
        $reportDetail = [];
        $reportDetail['initial_date'] = $request->initial_date;
        $reportDetail['final_date'] = $request->final_date;
        //dd($reportDetail);
        //Obtener los registros
        $recs = $this->getWeekRecordsByGivenDate($reportDetail['initial_date'], $reportDetail['final_date']);
        //dd($recs);
        //Calcular los entregados por cada dia del registro entregado
        $weekRecs = new Collection();

        foreach ($recs as $rec) {

            //Obtener los distribuidos hasta esa fecha
            $dist = $this->getDistribution('2019-03-25', $rec->date);


            $totalDist = $dist[0]->SSEE + $dist[0]->Antamina; //Total entregados

            //Porcentajes
            if ($totalDist != 0) {
                $percentage = (100 * $rec->connections) / $totalDist;
            } else {
                $percentage = 0.00;
            }


            $weekRecs->push((object)[
                'id' => $rec->id,
                'date' => $rec->date,
                'weekNum' => $rec->weekNum,
                'cTotal' => $rec->connections,
                'cAntamina' => $rec->antamina,
                'cSsee' => $rec->ssee,
                'dTotal' => $totalDist,
                'dAntamina' => $dist[0]->Antamina,
                'dSsee' => $dist[0]->SSEE,
                'pTotal' => number_format($percentage, 2, '.', ' '),
            ]);

            //dd($weekRecs);

        }

        //Distribución logistica
        $operations =  $this->getOperationsByGivenDates($reportDetail['initial_date'], $reportDetail['final_date']);
        //$opedevices = $this->getOperationsDetailByGivenDates($this->initial_date, $this->final_date);
        //dd($operations);

        //Distribución logisticia hasta



        //Paso 1 -
        //Obtenemos solo las OU(allOus)
        $allOUs = $this->getOUs();
        //Paso 2 -
        //Obtenemos cantidad de equipos entregados por todas las OU
        $currentDist = $this->getDistributionPerOu('2019-03-25', $reportDetail['final_date']);
        //dd($currentDist);
        //Paso 3 -
        //Hacemos un match entre $allOus y $ouResume como clave principal ouID
        $ousResume = $this->identifyQuantities($allOUs, $currentDist);
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

            if ($total == 0) {
                //do nothing
            } else {
                //Asignando a un nuevo array-multidimensional los nuevas cifras totales
                $ouResume['ouQuantity'] = $total;
            }



            $totalOU[] = $ouResume;
            //$ouParents[$ouResume['ouName']] = $total;
            //COndicion si la suma da cero pues mantente con tus entregados normales si no asignale

        }
        //dd($totalOU);

        return view('operator.report.generated', [
            'weekRecs' => $weekRecs,
            'allOU' => $this->getOUs(),
            'operations' => $operations,
            'reportDetail' => $reportDetail,
            'totalOU' => $totalOU
        ]);
    }


    /*Reporte disponibilidad de UO*/
    public function reportAvailabilityByOu(Request $request)
    {
        $reportDetail = [];
        $reportDetail['ou_id'] = $request->ou_id;
        $reportDetail['initial_date'] = $request->initial_date;
        $reportDetail['final_date'] = $request->final_date;

        /*
        $ou_id = 1; //Vicepresidencia de Operaciones 
        $initial_date = '2020-08-11'; //2020-08-11 al 31
        $final_date = '2020-08-31';*/

        $ou_id = $reportDetail['ou_id']; //Vicepresidencia de Operaciones 
        $initial_date = $reportDetail['initial_date']; //2020-08-11 al 31
        $final_date = $reportDetail['final_date'];

        $parentOU = OU::where('id', $ou_id)->first();
        //dd($parentOU);

        /*Identificar cada child del OU si lo tuviera*/
        //Paso 1 - Obtenemos solo las OU(allOus)
        $allOUs = $this->getOUs();
        //dd($allOUs);
        //Paso 2 - Detectar a sus hijos
        $childs = $this->detectOuChildsBySingle($allOUs, $ou_id);
        $ouList = $this->extractOuID($childs);
        //dd( $ouList);
        $ouList[] = $parentOU->id;
        //dd($ouList);
        //Paso 3 - Match list de hijos de la ou
        foreach ($allOUs as $ou) {
            foreach ($ouList as $child) {
                if ($ou->id == $child) {
                    $child = [
                        'ouID' => $child,
                        'ouName' => $ou->name,
                        'ouMasterOU' => $ou->master_ou,
                    ];
                    $newCollection[] = $child;
                }
            }
        }
        //dd($newCollection);




        $days = DB::select("CALL SP_GetRecordsDays('$initial_date','$final_date')");
        //dd(is_array($days));


        $weekDays = new Collection();
        /*POR DIA*/
        $weekRecs = new Collection();
        foreach ($days as $day) {

            //Lista los conectados por día
            $conns = $this->getRecordListDetail($day->id);
            //dd($conns);
            //Listar los distribucion de ese dia para hacer match por cada child
            $dist = $this->getDistributionPerOu('2020-03-25', $day->date);
            //dd($dist,$conns);

            $quantities = $this->matchQuantitiesBySingle($newCollection, $dist, $conns);
            //dd($quantities);
            //$dayOuQuantity = new Collection();
            /*Resumen por cada OU*/
            foreach ($quantities as $item) {
                //dd($item);
                //Detecto si tiene hijos
                //Solo sirve para ver el total de la ouParent
                $ouChilds = $this->detectOuChilds2($quantities, $item['ouID']);
                //dd($ouChilds);
                //Suma todos los entregados de los OuChilds
                $total = $this->sumAll($ouChilds);
                //dd($total);
                //Sumar todos los conectados
                $totalConns = $this->sumAllConnections($ouChilds);

                if ($total == 0 && $totalConns == 0) {
                    $total = $item['ouEnt'];
                    $totalConns = $item['ouConns'];
                } else {
                }
                //$ouResume->push((object)[
                $weekRecs->push((object)[
                    'id' => $day->id,
                    'date' => $day->date,
                    'weekNum' => $day->weekNum,
                    'ouId' =>  $item['ouID'],
                    'ouMaster' =>  $item['ouMasterID'],
                    //'ouName' =>  $item['ouName'],
                    'quantity' =>  $total,
                    'connected' => $totalConns
                    //'percentage' => number_format($percentage, 2, '.', ' ')
                ]);
            }
            //dd($dayOuQuantity);
            $weekDays[] = $day;
            //$weekRecs[] = $dayOuQuantity;

        }
        //dd($weekRecs,$days);
        //dd(is_object($allOUs[4]));
        //dd($parentOU);


        return view('operator.report.avlbltybyou', [
            "weekRecs" => $weekRecs,
            "weekDays" => $weekDays,
            "ouChilds" => $newCollection,
            "allOUs" => $allOUs,
            "parentOU" => $parentOU
        ]);
    }

    /*Reporte de distribución logistica General*/
    public function reportDistributionGen(Request $request)
    {
        $reportDetail = [];
        $reportDetail['initial_date'] = $request->initial_date;
        $reportDetail['final_date'] = $request->final_date;

        /*
        $initial_date = '2020-08-11'; //2020-08-11 al 31
        $final_date = '2020-08-31';
        */

        $initial_date = $reportDetail['initial_date']; //2020-08-11 al 31
        $final_date = $reportDetail['final_date'];

        

        //Distribución logistica
        $operations =  $this->getOperationsByGivenDates($initial_date, $final_date);



        //Paso 1 -
        //Obtenemos solo las OU(allOus)
        $allOUs = $this->getOUs();
        //Paso 2 -
        //Obtenemos cantidad de equipos entregados por todas las OU
        $currentDist = $this->getDistributionPerOu('2019-03-25', $final_date);
        //dd($currentDist);
        //Paso 3 -
        //Hacemos un match entre $allOus y $ouResume como clave principal ouID
        $ousResume = $this->identifyQuantities($allOUs, $currentDist);
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

            if ($total == 0) {
                //do nothing
            } else {
                //Asignando a un nuevo array-multidimensional los nuevas cifras totales
                $ouResume['ouQuantity'] = $total;
            }



            $totalOU[] = $ouResume;
            //$ouParents[$ouResume['ouName']] = $total;
            //COndicion si la suma da cero pues mantente con tus entregados normales si no asignale

        }
        //dd($totalOU);

        return view('operator.report.distgeneral', [
            'allOU' => $this->getOUs(),
            'operations' => $operations,
            'totalOU' => $totalOU
        ]);
    }
    /*Reporte de distribución logistica por OU*/
    public function reportDistributionByOU(Request $request)
    {
        $reportDetail = [];
        $reportDetail['ou_id'] = $request->ou_id;
        $reportDetail['initial_date'] = $request->initial_date;
        $reportDetail['final_date'] = $request->final_date;

        /*
        $initial_date = '2020-08-10'; //2020-08-11 al 31
        $final_date = '2021-08-31';
        $ou_id = 1;
        */

        $ou_id = $reportDetail['ou_id']; //Vicepresidencia de Operaciones 
        $initial_date = $reportDetail['initial_date']; //2020-08-11 al 31
        $final_date = $reportDetail['final_date'];

        

        //Distribución logistica 
        $parentOU = OU::where('id', $ou_id)->first();
        //dd($parentOU);

        /*Identificar cada child del OU si lo tuviera*/
        //Paso 1 - Obtenemos solo las OU(allOus)
        $allOUs = $this->getOUs();
        //dd($allOUs);
        //Paso 2 - Detectar a sus hijos
        $childs = $this->detectOuChildsBySingle($allOUs, $ou_id);
        //dd($childs);
        $ouList = $this->extractOuID($childs);
        //dd($ouList);
        $ouList[] = $parentOU->id;
        //dd($ouList);

        /* Distrubution */
        $dist = $this->getDistributionPerOu('2019-03-25', $final_date);
        //dd($dist);

        foreach ($allOUs as $ou) {
            foreach ($ouList as $child) {
                $q = 0;
                /*Matching quantity*/
                foreach ($dist as $d) {
                   if ($d->ouID == $child) {
                        $q = $d->ouEnt;
                   }
                }
                /*Matching Info*/
                if ($ou->id == $child) {
                    $child = [
                        'ouID' => $child,
                        'ouName' => $ou->name,
                        'ouMasterOU' => $ou->master_ou,
                        'ouQuantity' => $q
                    ];
                    $newCollection2[] = $child;
                }
                
                
            }
        }
        //dd($newCollection2);//Falta hacer suma real
        
        foreach ($newCollection2 as $child) {
            $total = 0;
            //Detectar sus childs
            if ($child['ouQuantity'] == 0) {
                
                $ouChilds = $this->detectOuChilds3($newCollection2, $child['ouID']);
                //Sumar los entregados de sus childs
                $total = $this->sumAll($ouChilds);
                //dd($total);
                $child['ouQuantity'] = $total;
                $newCollection[] = $child;                
            }else{
                $newCollection[] = $child;
            }

            
        }
       
        //dd($newCollection);



        $operations = new Collection();
        //$operations = [];
        foreach ($ouList as $child) {
            $o = $this->getOperationsByOUGivenDates($initial_date, $final_date, $child);
            $operations[] = $o;
        }
        $operations = $operations->collapse();
        //dd($operations);
        return view('operator.report.distbyou', [
            "operations" => $operations,
            "ouChilds" => $newCollection,
            "parentOU" => $parentOU
        ]);
    }
}
