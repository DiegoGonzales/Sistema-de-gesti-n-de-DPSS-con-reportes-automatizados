<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevicePropertiesController extends Controller
{
    public function index(){
        return view('operator.device-properties.index');
    }
}
