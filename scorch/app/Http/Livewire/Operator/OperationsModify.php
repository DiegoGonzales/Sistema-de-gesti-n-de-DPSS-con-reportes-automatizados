<?php

namespace App\Http\Livewire\Operator;

use App\Models\Device;
use App\Models\Operation;
use App\Models\OperationDevice;
use App\Models\OU;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OperationsModify extends Component
{
    use WithPagination;

    public $operation, $operid;



    //Disps. Agregados en Operación
    //sel diminutivo de selected dvcs devices
    public $selOperDvcs = [];
    public $selDvcs = [];

    /*Filtros*/
    public $paginate = 15;
    public $search = "";
    public $fFrom = null;
    public $fTo = null;

    public $selectPage = false;
    public $selectAll = false;

    public $selectAllOperDvcs = false;

    public $current;

    public function rules()
    {
        return [
            'operation.petitioner' => 'required',
            'operation.supervisor' => 'required',
            'operation.deliveredby' => 'required',
            'operation.comment' => 'nullable',
            'operation.active' => 'required',
            'operation.operation_date' => 'required',
            'operation.ou_id' => 'required'
        ];
    }

    public function mount(Operation $operation)
    {
        $this->operation = $operation;
    }

    public function render()
    {
        return view('livewire.operator.operations-modify', [
            'devices' => $this->getDevicesPag(),
            'allOU' => OU::all(),
            'operDevices' => $this->getOperationDevices(),

        ])->layout('layouts.app');
    }

    public function update()
    {
        $this->validate();

        //Obtener id de la operación antes de que se modifique y el router tenga problemas
        $operid = $this->operation->id;


        $this->timestamps = true;
        
        $this->operation->update();
        //Refrescar y llenar los datos nuevos en todo el campo
        $this->operation = Operation::find($operid);

        session()->flash('message', '¡Operacion modificada con exito!');
        $this->emit('updated');
    }
    public function getDevicesPag()
    {
        return $this->getDevices()->paginate($this->paginate);
    }

    public function getDevices()
    {

        if (isset($this->fFrom) && isset($this->fTo)) {
            return Device::latest('id')
                ->status($this->operation->type->origin_status_id)
                ->whereBetween('cod', [$this->fFrom, $this->fTo]);
        } else {
            return Device::latest('id')
                ->status($this->operation->type->origin_status_id) //tipo de operación detecta el status del device
                ->cod(trim($this->search));
        }
        //Los query scopes estan en el Model
        ///->paginate($this->paginate);
    }

    public function getOperationDevices()
    {
        return OperationDevice::where('operation_id', $this->operation->id)
            //->where('active', 0) //Cambiar a 0
            ->orderBy('device_id', 'asc')
            ->get();
    }

    public function updatedSelectAllOperDvcs($value)
    {
        if ($value) {
            $this->selOperDvcs = $this->getOperationDevices()->pluck('id')->map(function ($item) {
                return (string) $item;
            })->toArray();
        } else {
            $this->selOperDvcs = [];
        }
    }



    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selDvcs = $this->getDevicesPag()->pluck('id')->map(function ($item) {
                return (string) $item;
            })->toArray();
        } else {
            $this->selDvcs = [];
        }
    }



    public function selectAll()
    {
        $this->selectAll = true;
        $this->selDvcs = $this->getDevices()->pluck('id')->map(function ($item) {
            return (string) $item;
        })->toArray();

        /*$this->selDvcs = Device::latest('id')->status($this->operation->type->origin_status_id)->cod(trim($this->search))->pluck('id')->map(function($item){
            return (string) $item;
        })->toArray();*/
    }


    public function updatedSelDvcs()
    {
        $this->selectPage = false;
    }

    public function clean_page()
    {
        $this->reset('page');
    }




    public function confirm(Operation $operation)
    {

        //Obtener operDevices
        $operDevices = $this->getOperationDevices();
        $last = new OperationDevice();
        if ($operDevices->isEmpty()) {
            session()->flash('errormsg', 'Olvidaste agregar dispositivos');
        } else {

            foreach ($operDevices as $od) {

                //Revisar si existe un oper_device anterior ligado a este device
                $last = OperationDevice::where('device_id', $od->device_id) //$l de last
                    ->where('active', 1) //Donde este activo
                    ->latest()
                    ->get();

                if ($last->isNotEmpty()) {
                    //Si existe
                    //Cambiarlo a estado historico
                    DB::table('oper_device')
                        ->where('id', $last[0]['id'])
                        ->update(['active' => 2]);
                }


                //Actualizando el operDevice a activo
                DB::table('oper_device')
                    ->where('id', $od->id)
                    ->update(['active' => 1]);


                //Actualizando estado dispositivo con estado nuevo
                DB::table('device')
                    ->where('id', $od->device->id)
                    ->update(['status_id' => $operation->type->destiny_status_id]);
            }
        }


        //Confimar operación
        DB::table('operation')
            ->where('id', $operation->id)
            ->update(['active' => 1]); //active = 1 (Publicado o Actual)


        //Refrescar
        $this->operation = Operation::find($operation->id);

        session()->flash('successmsg', '¡Operación confirmada con exito!');
        $this->emit('confirmed');
    }

    //Función para remover cuando se selecciona con los checkboxes
    public function deleteOperDvcs(OperationDevice $selected)
    {
        foreach ($this->selOperDvcs as $item) {



            //Obtener el modelo oper_device seleccionado para eliminar
            $selected = OperationDevice::where('id', $item)->get();


            //Verificar si estuvo en una operación anteriormente activa
            $l = DB::table('oper_device') //$l de last
                ->where('device_id', $selected[0]['device_id'])
                ->where('active', 1) //Donde este activo
                ->latest()
                ->get();

            if ($l->isEmpty()) {
                //Si encontro cambiar estado EXP
                DB::table('device')
                    ->where('id', $selected[0]['device_id'])
                    ->update(['status_id' => 7]);
            } else {
                //Si esta vacio no cambiar su estado
            }

            //Eliminar 
            OperationDevice::where('id', $item)
                ->delete();
        }

        //Limpiar dispositivos seleccionados
        $this->selOperDvcs = [];
    }


    public function isSelOperDvcs($id)
    {
        return in_array($id, $this->selOperDvcs);
    }


    public function isSelDvcs($id)
    {
        return in_array($id, $this->selDvcs);
    }


    public function addDevices()
    {

        //Obteniendo id de la operación que se esta editando
        $operid = $this->operation->id;
        //Creando detalle por dispositivo
        //'device_id', 'operation_id','device_user_id','active'

        foreach ($this->selDvcs as $selDvc) {
            //Capturando el id del dispositivo
            $dvc_id = $selDvc;
            //Creando detalle por dispositivo
            $selDvc = new OperationDevice();
            $selDvc->operation_id = $operid;
            $selDvc->device_id = $dvc_id;
            $selDvc->device_user_id = null;
            $selDvc->active = 0; //Estado por confirmar
            $selDvc->save();
            //actualizando el estado del dispositivo en tabla device
            //actualizando el estado del dispositivo en tabla device

            $l = DB::table('oper_device') //$l de last
                ->where('device_id', $dvc_id)
                ->where('active', 1) //Donde este activo
                ->latest()
                ->get();

            if ($l->isEmpty()) {
                //Si encontro cambiar estado EXP
                DB::table('device')
                    ->where('id', $dvc_id)//->where('id', $l->device->id)
                    
                    ->update(['status_id' => 7]);
            } else {
                //Si esta vacio no cambiar su estado
            }
        }

        session()->flash('message', '¡Se añadieron ' . count($this->selDvcs) . ' dispositivos con exito!');
        //Limpiar dispositivos seleccionados
        $this->selDvcs = [];
    }
}
