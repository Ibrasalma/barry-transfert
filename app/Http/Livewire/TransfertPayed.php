<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Facture;

class TransfertPayed extends Component
{
    public $transferts_paid;
    public function render()
    {
        $this->transferts_paid = Facture::where('statut', 'payé')->get();
        return view('livewire.transfert-payed');
    }
}
