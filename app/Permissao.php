<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes'; //Model sempre cria o nome da classe no plural! ai precisamos proteger e corrigir o plural 
    //ex: aqui ele estava entendendo como permissaos

    public function users() {
        return $this->belongsToMany('App\User', 'users_permissoes', 'user_id', 'permissao_id');
    }

    public $timestamps = false;
}
