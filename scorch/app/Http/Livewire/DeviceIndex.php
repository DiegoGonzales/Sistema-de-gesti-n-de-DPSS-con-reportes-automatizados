<?php

namespace App\Http\Livewire;

use App\Models\Device;
use App\Models\DeviceStatus;
use App\Models\DeviceModel;

use Livewire\WithPagination;
use Livewire\Component;

class DeviceIndex extends Component
{
    use WithPagination;
    public $status_id;
    public $model_id;

    public function render()
    {
        $dvcs_status = DeviceStatus::all();
        $dvcs_model = DeviceModel::all();

        $devices = Device::latest('id')
            ->status($this->status_id)
            ->model($this->model_id)
            ->paginate(15);
        return view('livewire.device-index', compact('devices', 'dvcs_status', 'dvcs_model'));
    }
    public function resetFilters(){
        $this->reset(['status_id','model_id']);
    }
}
