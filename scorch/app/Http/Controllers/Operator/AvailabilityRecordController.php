<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Imports\RecDetailImport;
use App\Models\AvailabilityRecord;
use App\Models\AvailabilityRecordDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;

class AvailabilityRecordController extends Controller
{
    public function index()
    {
        return view('operator.availability.index'); //Ira al index.blade.php normal pero este lo redirigira al livewire
    }
    public function create()
    {
        return view('operator.availability.create');
    }
    public function searchDeviceForMatch($final, $codelike)
    {
        return DB::select("CALL SP_SearchDeviceForMatch('$final','$codelike')");
    }
    public function import(Request $request)
    {
        //Validar fecha y hora
        $validate = $this->validate($request, [
            'date' => 'required',
        ]);
        //Creando Availability Record
        $avrec = new AvailabilityRecord();
        $avrec->date = $request->input('date');
        $avrec->assessments = $request->input('assessments');
        $avrec->inactives = $request->input('inactives');
        $avrec->active = 0; //No publicado por defecto
        $avrec->save();

        $avrec_id = $avrec->id;

        //Leer Excel
        $items = Excel::toCollection(new RecDetailImport(), $request->file('import_file'));


        //Obtener ID del record
        foreach ($items[0] as $item) {
            //Obteniendo codigo CDM del dispositivo ($d dispositivo)
            $d = $item[7];

            //Match en BD consulta($s)
            $s = $this->searchDeviceForMatch($avrec->date, $d);
            //dd($s);
            /*$search = DB::table('device AS dev')
                ->join('oper_device AS opedev', 'dev.id', '=', 'opedev.device_id')
                ->rightJoin('operation AS ope', 'opedev.operation_id', '=', 'ope.id')
                ->select(DB::raw('dev.id AS did, ope.ou_id AS dou'))
                ->where('dev.cod', 'LIKE', '%' . $d . '%')
                ->get();*/

                //esta vacio? no, entonces registra
            if (empty($s) == false) {
                 //Crear Modelo RecordDetail
                 $recdet = new AvailabilityRecordDetail();
                 $recdet->avrec_id = $avrec_id;
                 $recdet->device_id = $s[0]->devId; //Device_id
                 $recdet->ou_id = $s[0]->devOu; //OU_id
                 //Guardando en BD
                 $recdet->save();
            }
        }

        return redirect()->back()->with(['message' => 'Corte generado satisfactoriamente']);
    }
}
