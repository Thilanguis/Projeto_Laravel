<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    public function enderecos(){
        return $this->hasMany(Endereco::class, 'pacientes_id');
        // return $this->hasMany('App\Endereco', 'pacientes_id');
    }

    public function getEnderecoPrincipalAttribute(){
        $enderecoPrincipal = $this->enderecos->first();
        $enderecoCompleto = "{$enderecoPrincipal->rua}, número {$enderecoPrincipal->numero}, complemento: {$enderecoPrincipal->complemento}";

        return $enderecoCompleto;
    }

    public function users() {
        return $this->belongsToMany('App\User', 'pacientes_users', 'pacientes_id', 'users_id');
    }

    // modelo de endereco 
    // public function endereco() {
        // return $this->hasOne(Endereco::class, 'pacientes_id');
    // }
}
