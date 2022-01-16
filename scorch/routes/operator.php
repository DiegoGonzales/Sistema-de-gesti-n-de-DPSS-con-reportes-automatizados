<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\Operator\AvailabilityRecordController;
use App\Http\Controllers\Operator\OperationController;
use App\Http\Controllers\Operator\OUController;
use App\Http\Controllers\Operator\ReportController;
use App\Http\Livewire\Operator\AvailabilityShow;
use App\Http\Livewire\Operator\DeviceProperties;
use App\Http\Livewire\Operator\OperationsModify;
use App\Http\Livewire\Operator\Report\TotalDistribution;
use App\Http\Livewire\Report\MultiformOperation;
use Illuminate\Support\Facades\Route;


//Route::redirect('', 'operator/ous');
Route::redirect('', 'operator');

//Dispositivos

Route::get('devices',[DeviceController::class, 'index'])->name('devices.index');
Route::get('devices/{device}',[DeviceController::class, 'show'])->name('devices.show');

//Registros de Disponibilidad por dia
Route::get('availability', [AvailabilityRecordController::class, 'index'])->name('availability.index');
Route::get('availability/{record}/show', AvailabilityShow::class)->name('availability.show');
Route::get('availability/create', [AvailabilityRecordController::class, 'create'])->name('availability.create');
Route::post('availability/create/import', [AvailabilityRecordController::class, 'import'])->name('availability.import');

Route::resource('ous', OUController::class)->names('ous');

//Route::get('operator/operations/{operation}/edit',[OperationEdit::class])->name('operations.edit');


//Route::redirect('', 'operator/operations');
Route::get('operations/{operation}/modify', OperationsModify::class)->name('operations.modify');
Route::resource('operations', OperationController::class)->names('operations');
//Este controlador se encuentra en app/http/controllers/operator/operationcontroller.php





/* Propiedades de Dispositivos CRUD */
Route::get('device-properties', DeviceProperties::class)->name('device-properties.index');
/* Reportes */
//Route::get('reports', Report::class)->name('report.index');
Route::get('report', [ReportController::class, 'create'])->name('report.index');

Route::get('report/generated', [ReportController::class, 'generated'])->name('report.generated');
Route::get('report/avlbltybyou', [ReportController::class, 'reportAvailabilityByOu'])->name('report.avlbltybyou');
Route::get('report/distgeneral', [ReportController::class, 'reportDistributionGen'])->name('report.distgeneral');
Route::get('report/distbyou', [ReportController::class, 'reportDistributionByOU'])->name('report.distbyou');


//Reporte Distribución Logística General 
Route::get('reports/totaldistribution', TotalDistribution::class)->name('report.totaldistribution');
//MultiStep Form Crear Operaciones
Route::get('multiform-operation', MultiformOperation::class)->name('multiform-operation.index');
