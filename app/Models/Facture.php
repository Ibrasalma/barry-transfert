<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compte;

class Facture extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function compte(){
        return belongsTo(Compte::class);
    }
}
