<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Operation;
use App\Models\OperationDevice;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{

    public function index()
    {

        return view('operator.operations.index');
        //La ubicación es resource/views/operator/operations/index.blade.php
    }


    public function show(Operation $operation)
    {
        $operDevices = OperationDevice::where('operation_id', $operation->id)
            ->where('active', 1)
            ->get();

        return view('operator.operations.show', compact('operation', 'operDevices'));
    }

    /*
    public function edit(Operation $operation)
    {
        return view('operator.operations.edit', compact('operation'));
    }
*/
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Operation $operation)
    {
    }

    public function cancel(Operation $operation)
    {
    }
}
