<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Facture;

class Compte extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at'];

    public function facture(){
        return $this->hasMany(Facture::class);
    }
}
