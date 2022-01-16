<?php

namespace App\Observers;

use App\Models\DeviceStatus;

class DeviceStatusObserver
{
    public function creating(DeviceStatus $device_status){
        $cod = $device_status->cod;
        $description = $device_status->description;
    }
    public function updating(DeviceStatus $device_status){
        $cod = $device_status->cod;
        $description = $device_status->description;
    }
}
