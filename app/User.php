<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pacientes() {
        return $this->belongsToMany('App\Paciente',  'pacientes_users',  'users_id', 'pacientes_id');
    }

    public function permissoes() {
        return $this->belongsToMany('App\Permissao', 'users_permissoes', 'permissao_id', 'user_id');
    }

    public function hasPermissao($nomePermissao){
        $permissaoExiste = $this->permissoes->filter(function($permissao) use($nomePermissao){
            return $permissao->nome == $nomePermissao;
        });

        return $permissaoExiste->count() > 0;
    }
}