<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    // scopeAtivos laravel entende que vc está querendo montar uma query ai no controller vc chama ativo
    // public function scopeAtivos($query){
    //     $query->where('numero', 123);
    // }
}
