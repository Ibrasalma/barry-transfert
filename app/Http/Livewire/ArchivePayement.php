<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Facture;

class ArchivePayement extends Component
{
    public $payements;
    public function render()
    {
        $this->payements = Facture::where('created_at',date('Y-m-d'))->where('statut', 'payé')->get();
        return view('livewire.archive-payement');
    }
}
