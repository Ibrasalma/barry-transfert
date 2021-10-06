<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Facture as AppFacture;
use App\Models\Compte;
use Livewire\WithFileUploads;

class Facture extends Component
{
    public $factures, $old_date, $old_picture, $delete_id, $les_comptes, $compte_id , $facture_id, $numero_facture, $montant, $photo, $created_at, $modelId, $detail;
    public $modalConfirmDeleteVisible = false;
    public $isModalOpen = 0;
    public $isDeleteModalOpen = 0;
    use WithFileUploads;

    public function render()
    {
        $this->factures = AppFacture::all();
        $this->les_comptes = Compte::all();
        return view('livewire.facture');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function suprimer($id)
    {
        $this->delete_id = $id;
        $this->openDeleteModalPopover();
    }

    public function openDeleteModalPopover()
    {
        $this->isDeleteModalOpen = true;
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function closeDeleteModalPopover()
    {
        $this->isDeleteModalOpen = false;
    }

    private function resetCreateForm(){
        $this->compte_id = '';
        $this->numero_facture = '';
        $this->photo = '';
        $this->montant = '';
        $this->created_at = '';
        $this->detail = '';
    }

    public function store()
    {
        $this->validate([
            'compte_id' => 'required',
            'numero_facture' => 'required',
            'montant' => 'required',
            'created_at' => !empty($this->facture_id) ? '' : 'required',
            'photo' => empty($this->facture_id) ? validateImage() : '',
        ]);

        if(!empty($this->photo)){
            $this->photo->storeAs('factures', $this->photo->getClientOriginalName());
        }

        if(!empty($this->facture_id)){
            $old_values = AppFacture::findOrFail($this->facture_id);
            $this->old_date = $old_values->created_at;
            $this->old_picture = $old_values->photo;
        }
        
        AppFacture::updateOrCreate(['id' => $this->facture_id], [
            'compte_id' => $this->compte_id,
            'numero_facture' => $this->numero_facture,
            'montant_rmb' => $this->montant,
            'created_at' => !empty($this->old_date) ? $this->old_date : changeDateFormate($this->created_at,'yyyy-mm-dd'),
            'photo' => !empty($this->old_picture) ? $this->old_picture : $this->photo->getClientOriginalName(),
            'detail' => $this->detail,
        ]);

        session()->flash('message', $this->facture_id ? 'Client modifié.' : 'Client crée.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $facture = AppFacture::findOrFail($id);
        $this->facture_id = $id;
        $this->compte_id = $facture->compte_id;
        $this->montant = $facture->montant_rmb;
        $this->numero_facture = $facture->numero_facture;
        $this->created_at = $facture->created_at;
        $this->detail = $facture->detail;
        $this->photo = $facture->photo;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        AppFacture::find($id)->delete();
        $this->closeDeleteModalPopover();
        session()->flash('message', 'Client supprimé.');
    }
}
