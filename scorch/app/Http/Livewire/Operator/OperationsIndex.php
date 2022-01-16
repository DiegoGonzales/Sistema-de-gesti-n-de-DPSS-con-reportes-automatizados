<?php

namespace App\Http\Livewire\Operator;

use App\Models\Operation;
use App\Models\OperationDevice;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OperationsIndex extends Component
{
    use WithPagination;
    public $search,$selectedOperation;

    public function mount(){
        $this->selectedOperation = new Operation();
    }

    public function render()
    {
        $operations = Operation::where('ou_id', 'LIKE', '%' . $this->search . '%')
            ->latest('operation_date')
            ->paginate(15);
    
        return view('livewire.operator.operations-index', compact('operations'))->layout('layouts.app');
        //Equivale a resource/views/livewire/operator/operations-index.blade.php
    }

    public function clean_page()
    {
        $this->reset('page');
    }

    public function select(Operation $selectedOperation)
    {
        $this->selectedOperation = $selectedOperation;
    }
    //Anular Operación
    public function cancel(Operation $selectedOperation){
        /*
        0 Pendiente de aprobación
        1 Aprobada
        2 Anulada
        */
        $this->selectedOperation = $selectedOperation;

        $operation_id = $selectedOperation->id;
        //Obteniendo los dispositivo ligados a la operación
        $operDevices = OperationDevice::where('operation_id', $operation_id)->get();

        switch ($this->selectedOperation->active) {
            //Pendiente de aprobar entonces elimina todos los devices asignados
            case (0):
            case (2):
                foreach($operDevices as $operDevice){
                    $operDevice->delete();
                }
                //Cambiar el estado de la operación
               Operation::where('id', $operation_id)->delete();//Eliminar
            break;
            //Aprobada entonces cambia el estado del operDevice y actualiza el estado de los dispositivos a ALM
            case (1):
                foreach($operDevices as $operDevice){
                    $device_id = $operDevice->id;//Obteniendo el ID del dispositivo
                    $operDevice = DB::table('oper_device')
                        ->update(['active' => 0]);// OperDevice->active = 0 (Anulado o Historioc)

                    //Dispositivo regresa a almacen
                    DB::table('device')
                        ->where('id', $device_id)
                        ->update(['status_id' => 1]);// 1=ALM
                }
            //Cambiar el estado de la operación
            $selectedOperation = Operation::where('id', $operation_id)
            ->update(['active' => 2]);//Anulada
            break;
        }

        //Anular

        
        
        session()->flash('message', '¡Operacion anulada con exito!');

    }
}
