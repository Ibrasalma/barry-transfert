<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Payement;
use App\Models\Facture;
use Livewire\WithFileUploads;

class Payment extends Component
{
    use WithFileUploads;
    public $payments,$old_date, $payment_id, $old_picture, $les_factures, $facture_id , $montant, $moyen_payement, $photo, $created_at, $modelId, $detail;
    public $modalConfirmDeleteVisible = false;
    public $isModalOpen = 0;

    public function render()
    {
        $this->payments = Payement::all();
        $this->les_factures = Facture::all();
        return view('livewire.payment');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->facture_id = '';
        $this->photo = '';
        $this->montant = '';
        $this->moyen_payement = '';
        $this->created_at = '';
        $this->detail = '';
    }
    
    public function store()
    {
        $this->validate([
            'facture_id' => 'required',
            'montant' => 'required',
            'moyen_payement' => 'required',
            'created_at' => !empty($this->payment_id) ? '' : 'required',
            'photo' => empty($this->payment_id) ? validateImage() : '',
        ]);

        if(!empty($this->photo)){
            $this->photo->storeAs('payments', $this->photo->getClientOriginalName());
        }

        if(!empty($this->payment_id)){
            $old_values = Payement::findOrFail($this->facture_id);
            $this->old_date = $old_values->created_at;
            $this->old_picture = $old_values->photo;
        }
        
        if(!empty(Payement::where('code', $this->facture_id)->get())){
            $montant_total_versee = Payement::where('code', $this->facture_id)->sum('montant_versee') + $this->montant;
        }else{
            $montant_total_versee = $this->montant;
        }
        
        $facture_data = Facture::findOrFail($this->facture_id);
        $montant_restant = $facture_data->montant_rmb - $montant_total_versee;
        if($montant_restant < 0){
            session()->flash('message', 'Payement impossible | Veuillez verifier le montant payé car le reste ne doit pas être negatif');
        }else {
            Payement::updateOrCreate(['id' => $this->payment_id], [
                'code' => $this->facture_id,
                'montant_versee' => $this->montant,
                'total_versee' => $montant_total_versee,
                'reste' => $montant_restant,
                'created_at' => !empty($this->old_date) ? $this->old_date : changeDateFormate($this->created_at),
                'notification' => !empty($this->old_picture) ? $this->old_picture : $this->photo->getClientOriginalName(),
                'moyen_versement' => $this->moyen_payement,
                'detail' => $this->detail,
            ]);

            if($montant_restant == 0){
                Facture::where('id', $this->facture_id)->update(['statut' => 'payé']);
                $message_update = 'Statut du dépôt mis à jour à payé';
                session()->flash('message', $this->payment_id ? 'Client modifié | '.$message_update : 'Client crée | '.$message_update);
            }else{
                session()->flash('message', $this->payment_id ? 'Client modifié.' : 'Client crée.');
            }
        }
        
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $versement = Payement::findOrFail($id);
        $this->payment_id = $id;
        $this->numero_facture = $versement->code;
        $this->montant = $versement->montant_versee;
        $this->moyen_payement = $versement->moyen_payement;
        $this->created_at = $versement->created_at;
        $this->detail = $versement->detail;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Payement::find($id)->delete();
        session()->flash('message', 'Client supprimé.');
    }
}
