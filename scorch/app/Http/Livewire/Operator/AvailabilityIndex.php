<?php

namespace App\Http\Livewire\Operator;

use App\Models\AvailabilityRecord;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AvailabilityIndex extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.operator.availability-index', [ //Una vez que entras al route de AvailabilityRecordsController.index te redigire a esta vista
            'records' => $this->getAvailabilityRecords()
        ])->layout('layouts.app');
    }

    public function getAvailabilityRecords()
    {
        $user = Auth::user();
        if ($user->role == 0) {
            return AvailabilityRecord::orderBy('date')->paginate(15);
        }elseif($user->role == 1){
            return AvailabilityRecord::where('active', 1)->orderBy('date')->paginate(15);
        }
        
    }

    public function publish(AvailabilityRecord $selectedRecord)
    {
        /*
        0 Sin publicar
        1 Publicado
        */
        $this->selectedRecord = $selectedRecord;
        //dd($selectedRecord);
        $record_id = $selectedRecord->id;

        switch ($this->selectedRecord->active) {
            case (0):
                $selectedRecord = AvailabilityRecord::where('id', $record_id)->update(['active' => 1]); //Publicado
            break;
            case (1):
                $selectedRecord = AvailabilityRecord::where('id', $record_id)->update(['active' => 0]); //Pasar a sin publicar
            break;
        }

        
    }
}
