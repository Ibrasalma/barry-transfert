<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Depot;

class Client extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at'];

    public function depot(){
        return $this->hasMany(Depot::class);
    }
}
