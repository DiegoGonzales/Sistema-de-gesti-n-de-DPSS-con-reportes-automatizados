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
    public $selectPage = false;
    public $currentPage = 1;/*
    public $selectedOperType = [
        'id' => '4',
        'origin_status_id' => '4'
    ];*/
    public $selectedOperType,$operDevice,$search;
    //Form Properties
    public $petitioner, $supervisor, $deliveredby, $comment,$active = 0,$operation_date, $type_id, $ou_id;
    public $selectedDevices = [];    
    

    public $pages = [
        1 => [
            'heading' => 'Nueva Operacion',
            'subheading' => 'Seleccionar tipo de operación'
        ],
        2 => [
            'heading' => 'Datos Importantes',
            'subheading' => 'Ingresar datos y seleccionar dispositivos'
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

    public function clean_page()
    {
        $this->reset('page');
    }
    
    public function updatedSelectPage($value){
        if($value){
            
        }else{
            $this->selectedDevices=[];
        }
    }



    public function render()
    {
        //Listar Organizative Units
        $allOU = OU::get();
        //Listar OperationTypes
        $opertypes = OperationType::all();
        //Listar devices con filtro segun la tipo de operación seleccionada y el origin status que pide para esa operación
        $devices = Device::latest('id')
            ->where('cod', 'LIKE', '%' . $this->search . '%')
            ->status($this->selectedOperType['origin_status_id'])
            ->paginate(15);


        return view('livewire.report.multiform-operation', compact('allOU', 'opertypes', 'devices'))->layout('layouts.app');
    }

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
                $selectedDevice->active = 1;
                $selectedDevice->save();
                 //actualizando el estado del dispositivo en tabla device
                DB::table('device')
                    ->where('id', $device_id)
                    ->update(['status_id' => $this->selectedOperType['destiny_status_id']]);
            }
        
        session()->flash('message', '¡Operacion creada con exito!');
    }
}
