<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Depot;

class VersementPayed extends Component
{
    public $depots_paid;
    public function render()
    {
        $this->depots_paid = Depot::where('statut','payé')->get();
        return view('livewire.versement-payed');
    }
}
