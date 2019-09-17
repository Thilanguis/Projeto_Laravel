<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    public function enderecos(){
        return $this->hasMany(Endereco::class, 'pacientes_id');
        // return $this->hasMany('App\Endereco', 'pacientes_id');
    }
}
