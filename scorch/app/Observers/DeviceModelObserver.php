<?php

namespace App\Observers;

use App\Models\DeviceModel;

class DeviceModelObserver
{
    public function creating(DeviceModel $device_model){
        $brand = $device_model->brand;
        $model = $device_model->model;
    }
    public function updating(DeviceModel $device_model){
        $brand = $device_model->brand;
        $model = $device_model->model;
    }
}
