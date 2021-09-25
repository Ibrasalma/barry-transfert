<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compte;

class Facture extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at'];

    public function compte(){
        return belongsTo(Compte::class);
    }
}
