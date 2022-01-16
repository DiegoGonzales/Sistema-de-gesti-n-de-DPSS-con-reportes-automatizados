<?php

namespace App\Http\Livewire\Operator;

use App\Models\DeviceModel;
use App\Models\DeviceStatus;
use Livewire\Component;

class DeviceProperties extends Component
{
    public $selectedStatus,$selectedModel, $description, $cod, $newModel, $deviceBrand, $deviceModel;


    protected $rules = [
        'selectedStatus.cod' => 'required',
        'selectedStatus.description' => 'required'
    ];
    //Hay conflicto al actualizar
    /*
    
        'selectedModel.model' => 'required|max:45',
        'selectedModel.brand' => 'required|max:45'
    */
    public function mount()
    {
        $this->selectedStatus = new DeviceStatus();
        $this->selectedModel = new DeviceModel();
    }

    public function render()
    {
        //Listar device_status
        $device_states = DeviceStatus::get();
        //Listar device_status
        $device_models = DeviceModel::get();
        return view('livewire.operator.device-properties', compact('device_states','device_models'))->layout('layouts.app');
    }
    public function edit(DeviceStatus $selectedStatus)
    {
        $this->resetValidation();
        $this->selectedStatus = $selectedStatus;
    }
    public function update()
    {
        //Reglas de validación
        $this->validate();
        //Guardar en BD
        $this->selectedStatus->save();
        //Limpiar lo que tengo en selectedStatus
        $this->selectedStatus = new DeviceStatus();
        //Refrescar
        $this->device_states = DeviceStatus::get();
    }
    public function cancel()
    {
        //Limpiar lo que tengo en selectedStatus
        $this->selectedStatus = new DeviceStatus();
        $this->selectedModel = new DeviceModel();
    }
    public function store()
    {
        //Reglas validación
        $rules = [
            'cod' => 'required|size:3',
            'description' => 'required|max:255'
        ];
        //Validar $rules
        $this->validate($rules);

        //Crear en BD
        DeviceStatus::create([
            'cod' => $this->cod,
            'description' => $this->description
        ]);
        //Limpiar los campos
        $this->reset(['cod','description']);
        //Refrescar
        $this->device_states = DeviceStatus::get();
    }
    
    public function destroy(DeviceStatus $selectedStatus){ 
        $selectedStatus->delete();
        //Refrescar
        $this->device_states = DeviceStatus::get();
    } 

    //Modelo

    public function store_Model()
    {
        //Reglas validación
        $rules = [
            'deviceBrand' => 'required|max:45',
            'deviceModel' => 'required|max:45'
        ];
        //Validar $rules
        $this->validate($rules);
        //Crear en BD
        $deviceBrand = $this->deviceBrand;
        $deviceModel = $this->deviceModel;

        $newModel = new DeviceModel();
        $newModel->brand = $deviceBrand;
        $newModel->model = $deviceModel;

        $newModel->save();
        
        //Limpiar los campos
        $this->reset(['deviceBrand','deviceModel']);
        //Refrescar
        $this->device_models = DeviceModel::get();
    }
    public function destroyModel(DeviceModel $selectedModel){ 
        $selectedModel->delete();
        //Refrescar
        $this->device_models = DeviceModel::get();
    } 
    public function editModel(DeviceModel $selectedModel)
    {
        $this->resetValidation();
        $this->selectedModel = $selectedModel;
    }
    public function updateModel()
    {
        //Reglas de validación
        $this->validate();
        //Guardar en BD
        $this->selectedModel->save();
        //Limpiar lo que tengo en selectedStatus
        $this->selectedModel = new DeviceModel();
        //Refrescar
        $this->device_models = DeviceModel::get();
    }
}
