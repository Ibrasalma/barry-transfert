<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Student;
use App\Models\Versement;

class Depot extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function versement(){
        return $this->hasMany(Versement::class);
    }
}
