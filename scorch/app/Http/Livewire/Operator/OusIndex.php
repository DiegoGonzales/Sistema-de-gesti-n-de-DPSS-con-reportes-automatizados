<?php

namespace App\Http\Livewire\Operator;

use App\Models\OU;
use Livewire\Component;
use Livewire\WithPagination;

class OusIndex extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $ous = OU::where('name', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(15);
        return view('livewire.operator.ous-index', compact('ous'));
    }

    public function clean_page()
    {
        $this->reset('page');
    }
}
