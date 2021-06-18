<?php

namespace App;

use App\Cliente;
use App\Formacao;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = ['id'];

    public function formacao() 
    { 
        return  $this->belongsToMany(Formacao::class);
    }
}
