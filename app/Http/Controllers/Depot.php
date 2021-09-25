<?php

namespace App\Http\Controllers;
use App\Models\Depot as DepotModel;

use Illuminate\Http\Request;

class Depot extends Controller
{
    public function paid(){
        $depots_paid = DepotModel::where('statut', '=', 'payé')->get();
        return view('livewire.depot_payee', compact('depots_paid'));
    }

    public function notPaid(){
        $depots_notPaid = DepotModel::where('statut', '=', 'non payé')->get();
        return view('livewire.depot_nonPayee', compact('depots_notPaid'));
    }
}
