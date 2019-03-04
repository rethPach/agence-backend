<?php

namespace App\Src\Models;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
	protected $table = 'cao_sistema';

	protected $fillable = [
 		"co_sistema",
    "co_cliente",
    "co_usuario",
    "co_arquitetura",
    "no_sistema",
    "ds_sistema_resumo",
    "ds_caracteristica",
    "ds_requisito",
    "no_diretoria_solic",
    "ddd_telefone_solic",
    "nu_telefone_solic",
    "no_usuario_solic",
    "dt_solicitacao",
    "dt_entrega",
    "co_email"
 	];

  public function id()
  {
    return $this->co_sistema;
  }

  public function nome()
  {
    return $this->no_sistema;
  }
}

