<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Versement as AppVersement;
use App\Models\Depot;
use Livewire\WithFileUploads;

class Versement extends Component
{
    use WithFileUploads;
    public $versements,$old_date, $versement_id, $old_picture, $les_depots, $depot_id , $montant, $moyen_payement, $photo, $photo_name, $created_at, $modelId, $detail;
    public $modalConfirmDeleteVisible = false;
    public $isModalOpen = 0;
    
    public function render()
    {
        $this->versements = AppVersement::all();
        $this->les_depots = Depot::all();
        return view('livewire.versement');
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
        $this->depot_id = '';
        $this->photo = '';
        $this->montant = '';
        $this->moyen_payement = '';
        $this->created_at = '';
        $this->detail = '';
    }
    
    public function store()
    {
        $this->validate([
            'depot_id' => 'required',
            'montant' => 'required',
            'moyen_payement' => 'required',
            'created_at' => !empty($this->versement_id) ? '' : 'required',
            'photo' => empty($this->versement_id) ? validateImage() : '',
        ]);

        if(!empty($this->photo)){
            $this->photo_name = $this->photo->getClientOriginalName();
            $this->photo->storeAs('public/photos/versements', $this->photo_name);
        }

        if(!empty($this->versement_id)){
            $old_values = AppVersement::findOrFail($this->versement_id);
            $this->old_date = $old_values->created_at;
            $this->old_picture = $old_values->notification;
        }
        //session()->flash('message', $this->old_picture);
        if(!empty(AppVersement::where('code', $this->depot_id)->get())){
            $montant_total_versee = AppVersement::where('code', $this->depot_id)->sum('montant_versee') + $this->montant;
        }else{
            $montant_total_versee = $this->montant;
        }
        
        $depot_data = Depot::findOrFail($this->depot_id);
        $montant_restant = $depot_data->montant_rmb - $montant_total_versee;
        if($montant_restant < 0){
            session()->flash('message', 'Payement impossible | Veuillez verifier le montant payé car le reste ne doit pas être negatif');
        }else {
            AppVersement::updateOrCreate(['id' => $this->versement_id], [
                'code' => $this->depot_id,
                'montant_versee' => $this->montant,
                'total_versee' => $montant_total_versee,
                'reste' => $montant_restant,
                'created_at' => !empty($this->old_date) ? $this->old_date : changeDateFormate($this->created_at),
                'notification' => !empty($this->old_picture) ? $this->old_picture : $this->photo_name,
                'moyen_versement' => $this->moyen_payement,
                'detail' => $this->detail,
            ]);

            if($montant_restant == 0){
                Depot::where('id', $this->depot_id)->update(['statut' => 'payé']);
                $message_update = 'Statut du dépôt mis à jour à payé';
                session()->flash('message', $this->versement_id ? 'Versement modifié | '.$message_update : 'Versement crée | '.$message_update);
            }else{
                session()->flash('message', $this->versement_id ? 'Versement modifié.' : 'Versement crée.'.$this->created_at);
            }
        }
        
        $this->closeModalPopover();
        $this->resetCreateForm(); 
    }

    public function edit($id)
    {
        $versement = AppVersement::findOrFail($id);
        $this->versement_id = $id;
        $this->depot_id = $versement->code;
        $this->montant = $versement->montant_versee;
        $this->moyen_payement = $versement->moyen_versement;
        $this->created_at = $versement->created_at;
        $this->detail = $versement->detail;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        AppVersement::find($id)->delete();
        session()->flash('message', 'Client supprimé.');
    }
}
