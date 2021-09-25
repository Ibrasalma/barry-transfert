<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Depot;

class VersementNotPayed extends Component
{
    public $depots_notPaid;
    public function render()
    {
        $this->depots_notPaid = Depot::where('statut','non payé')->get();
        return view('livewire.versement-not-payed');
    }
}
