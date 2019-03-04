<?php

namespace App\Src\Models;

use Illuminate\Database\Eloquent\Model;

class PermissaoSistema extends Model
{
	protected $table = 'permissao_sistema';

 	protected $fillable = [
 		"co_usuario",
    "co_tipo_usuario",
    "co_sistema",
    "in_ativo",
    "co_usuario_atualizacao",
    "dt_atualizacao"
 	];


}