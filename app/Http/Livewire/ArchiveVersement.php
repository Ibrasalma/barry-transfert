<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Depot;

class ArchiveVersement extends Component
{
    public $versements;
    public function render()
    {
        $this->versements = Depot::where('created_at',date('Y-m-d'))->where('statut', 'payé')->get();
        return view('livewire.archive-versement');
    }
}
