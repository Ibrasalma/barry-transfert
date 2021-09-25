<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Depot;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'email', 
        'mobile'
    ]; 

    public function depot(){
        return $this->hasMany(Depot::class);
    } 
}
