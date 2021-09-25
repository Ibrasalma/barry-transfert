<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Facture;

class TransfertNotPayed extends Component
{
    public $transferts_not_paid;
    public function render()
    {
        $this->transferts_not_paid = Facture::where('statut', 'non payé')->get();
        return view('livewire.transfert-not-payed');
    }
}
