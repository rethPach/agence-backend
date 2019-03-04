<?php

namespace App\Src\Models;

use Illuminate\Database\Eloquent\Model;

class CustFixo extends Model
{
	protected $table = 'cao_salario';

	protected $fillable = [
		"co_usuario",
		"dt_alteracao",
		"brut_salario",
		"liq_salario"
	];

	public function salarioBruto()
	{
		return $this->brut_salario;
	}
}
