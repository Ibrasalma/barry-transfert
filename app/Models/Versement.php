<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Depot;

class Versement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function depot(){
        return $this->belongsTo(Depot::class);
    }
}
