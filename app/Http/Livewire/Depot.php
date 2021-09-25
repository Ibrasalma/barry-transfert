<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Depot as AppDepot;
use App\Models\Student;
use Livewire\WithFileUploads;

class Depot extends Component
{
    public $depots, $old_date, $old_picture, $les_clients, $the_date, $first_part, $client_id , $depot_id, $name, $montant, $taux, $photo, $created_at, $modelId, $detail;
    public $modalConfirmDeleteVisible = false;
    public $isModalOpen = 0;
    use WithFileUploads;

    

    public function render()
    {
        $this->depots = AppDepot::all();
        $this->les_clients = Student::all();
        return view('livewire.depot');
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
        $this->name = '';
        $this->client_id = '';
        $this->taux = '';
        $this->photo = '';
        $this->montant = '';
        $this->created_at = '';
        $this->detail = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'client_id' => 'required',
            'montant' => 'required',
            'taux' => !empty($this->depot_id) ? '' : 'required',
            'created_at' => !empty($this->depot_id) ? '' : 'required',
            'photo' => empty($this->depot_id) ? validateImage() : '',
        ]);

        if(!empty($this->photo)){
            $this->photo->storeAs('public/photos/depots', $this->photo->getClientOriginalName());
        }

        $this->first_part = substr($this->name, 0, strpos($this->name, ' '));
        $value_to_replace = [' ','/', ':'];
        $value_replaced = ['','',''];
        $this->the_date = str_replace($value_to_replace, $value_replaced, date('Y/m/d H:i:s'));
        if(!empty($this->depot_id)){
            $old_values = AppDepot::findOrFail($this->depot_id);
            $this->old_date = $old_values->created_at;
            $this->old_picture = $old_values->photo;
        }
        
        AppDepot::updateOrCreate(['id' => $this->depot_id], [
            'recepteur' => $this->name,
            'client_id' => $this->client_id,
            'code_depot' => $this->first_part.''.$this->the_date,
            'montant' => $this->montant,
            'montant_rmb' => !empty($this->taux) ? $this->montant * $this->taux : $this->montant * 6.4,
            'created_at' => !empty($this->old_date) ? $this->old_date : changeDateFormate($this->created_at,'yyyy-mm-dd'),
            'recu' => !empty($this->old_picture) ? $this->old_picture : $this->photo,
            'detail' => $this->detail,
        ]);

        session()->flash('message', $this->depot_id ? 'Client modifié.' : 'Client crée.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $depot = AppDepot::findOrFail($id);
        $this->depot_id = $id;
        $this->name = $depot->recepteur;
        $this->montant = $depot->montant;
        $this->client_id = $depot->client_id;
        $this->created_at = $depot->created_at;
        $this->detail = $depot->detail;
        $this->photo = $depot->photo;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        AppDepot::find($id)->delete();
        session()->flash('message', 'Client supprimé.');
    }

}
