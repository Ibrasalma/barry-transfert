<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Compte as CompteModel;
use Livewire\WithFileUploads;

class Compte extends Component
{
    use WithFileUploads;
    public $comptes, $qr_wechat, $name, $marque, $wechat_id, $compte_bancaire, $mobile, $compte_id, $qr_alipay, $old_alipay, $old_wechat, $modelId;
    public $modalConfirmDeleteVisible = false;
    public $isModalOpen = 0;

    public function render()
    {
        $this->comptes = CompteModel::all();
        return view('livewire.compte');
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
        $this->marque = '';
        $this->mobile = '';
        $this->qr_wechat = '';
        $this->qr_alipay = '';
        $this->compte_bancaire = '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'marque' => 'required',
            'mobile' => 'required',
            'qr_wechat' => empty($this->compte_id) ? validateImage() : '',
            'qr_alipay' => empty($this->compte_id) ? validateImage() : '',
            'compte_bancaire' => 'max:11'
        ]);
        if(!empty($this->qr_alipay)){
            $this->qr_alipay->storeAs('public/photos/comptes', $this->qr_alipay->getClientOriginalName());
        }
        if(!empty($this->qr_wechat)){
            $this->qr_wechat->storeAs('public/photos/comptes', $this->qr_wechat->getClientOriginalName());
        }
        if(!empty($this->compte_id)){
            $old_values = CompteModel::findOrFail($this->compte_id);
            $this->old_alipay = $old_values->qr_alipay;
            $this->old_wechat = $old_values->qr_wechat;
        }
        CompteModel::updateOrCreate(['id' => $this->compte_id], [
            'name' => $this->name,
            'marque' => $this->marque,
            'telephone' => $this->mobile,
            'wechat_id' => $this->wechat_id,
            'compte_bancaire' => $this->compte_bancaire,
            'qr_wechat' => !empty($this->old_wechat) ? $this->old_wechat : $this->qr_wechat,
            'qr_alipay' => !empty($this->old_alipay) ? $this->old_alipay : $this->qr_alipay,
        ]);

        session()->flash('message', $this->compte_id ? 'Client modifié.' : 'Client crée.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $compte = CompteModel::findOrFail($id);
        $this->compte_id = $id;
        $this->name = $compte->name;
        $this->marque = $compte->marque;
        $this->mobile = $compte->telephone;
        $this->wechat_id = $compte->wechat_id;
        $this->compte_bancaire = $compte->compte_bancaire;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        CompteModel::find($id)->delete();
        session()->flash('message', 'Client supprimé.');
    }

}
