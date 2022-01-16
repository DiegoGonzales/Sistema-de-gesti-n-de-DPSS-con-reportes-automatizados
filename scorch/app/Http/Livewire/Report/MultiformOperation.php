<?php

namespace App\Http\Livewire\Report;

use App\Models\Device;
use App\Models\Operation;
use App\Models\OperationDevice;
use App\Models\OperationType;
use App\Models\OU;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MultiformOperation extends Component
{
    use WithPagination;
   
    public $currentPage = 1;

    public $selectedOperType;
    //Form Properties
    public $petitioner, $supervisor, $deliveredby, $comment,$active = 0,$operation_date, $type_id, $ou_id;
    //Disps. Seleccionados
    public $selectedDevices = [];   
    
    /*Filtros*/
    public $paginate = 10;
    public $search = "";

    /*Select all Checkboxes*/
    public $selectPage = false;
    public $selectAll = false;
    

    public $pages = [
        1 => [
            'heading' => 'Nueva Operacion',
            'subheading' => 'Selecciona el tipo de operación a registrar'
        ],
        2 => [
            'heading' => 'Datos Importantes',
            'subheading' => 'Ingresar los datos del acta '
        ],
    ];

    public function nextPage()
    {
        $this->currentPage++;
    }
    public function backPage()
    {
        //Limpiar los campos
        $this->reset(['petitioner','supervisor','deliveredby','active','comment','selectedDevices','type_id','ou_id']);
        $this->currentPage--;
    }

    public function render()
    {
        return view('livewire.report.multiform-operation',[ 
            'allOU' => OU::all(), 
            'opertypes' => OperationType::all(), 
            'devices' => $this->getDevices(),
            ])->layout('layouts.app');
    }

    public function updatedSelectPage($value){
        if($value){
            $this->selectedDevices = $this->getDevices()->pluck('id')->map(function($item){
                return (string) $item;
            })->toArray();
        }else{
            $this->selectedDevices=[];
        }
    }
    
    public function updatedSelectedDevices()
    {
        $this->selectPage = false;
    }

    public function getDevices(){
        return Device::latest('id')
                ->status($this->selectedOperType['origin_status_id'])
                ->cod(trim($this->search))//Los query scopes estan en el Model
                ->paginate($this->paginate);
    }

    public function clean_page()
    {
        $this->reset('page');
    }
    
    public function isChecked($id){
        return in_array($id,$this->selectedDevices);
    }
   

    //Seleccionar Tipo de Operacion
    public function select(OperationType $selectedOperType)
    {
        //Seleccionar tipo de operación
        $this->selectedOperType = $selectedOperType;
        $this->currentPage++;
    }


    public function store()
    {

        //Reglas validación
        $rules = [
            'petitioner' => 'required',
            'supervisor' => 'required',
            'deliveredby' => 'required',
            'comment' => 'nullable',
            'operation_date' => 'required|date',
            'ou_id' => 'required'
        ];
        //Validar $rules
        $this->validate($rules);

        //Crear en BD
        $newoperation = Operation::create([
            'petitioner' => $this->petitioner,
            'supervisor' => $this->supervisor,
            'deliveredby' => $this->deliveredby,
            'comment' => $this->comment,
            'operation_date' => $this->operation_date,
            'active' => 0,
            'type_id' => $this->selectedOperType['id'],
            'ou_id' => $this->ou_id
        ]);

        //Obteniendo id de la operación recien creada
        $lastID = $newoperation->id;
        
        //Creando detalle por dispositivo
            //'device_id', 'operation_id','device_user_id','active'
            foreach ($this->selectedDevices as $selectedDevice) {
                //Capturando el id del dispositivo
                $device_id = $selectedDevice; 
                //Creando detalle por dispositivo
                $selectedDevice = new OperationDevice();
                $selectedDevice->operation_id = $lastID;
                $selectedDevice->device_id = $device_id;
                $selectedDevice->device_user_id = null;
                $selectedDevice->active = 0;//Pendiente de Aprobación
                $selectedDevice->save();
                //actualizando el estado del dispositivo en tabla device
                DB::table('device')
                    ->where('id', $device_id)
                    ->update(['status_id' => 7]);//Estado por confirmar
            }
        
        session()->flash('message', '¡Operacion creada con exito!');
    }
}
