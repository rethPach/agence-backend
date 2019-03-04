<?php

namespace App\Src\Models\Fatura;

use Illuminate\Database\Eloquent\Model;

class FaturaEntity extends Model
{
	
 	protected $table = 'cao_fatura';

 	protected $fillable = [
 		"co_fatura",
    "co_cliente",
    "co_sistema",
    "co_os",
    "num_nf",
    "total",
    "valor",
    "data_emissao",
    "corpo_nf",
    "comissao_cn",
    "total_imp_inc"
 	];

 	public function sistema()
	{
		return $this->hasOne('App\Src\Models\Sistema', 'co_sistema', 'co_sistema');
	}

	public function servicioConsultor()
	{
		return $this->hasOne('App\Src\Models\ServicioConsultor', 'co_os', 'co_os');
	}

  public function cliente()
  {
    return $this->hasOne('App\Src\Models\Cliente', 'co_cliente', 'co_cliente');
  }

  public function custFixo()
  {
    return $this->servicioConsultor->consultor->custFixo;
  }

  public function salarioBrutoConsultor()
  {
    if(!$this->custFixo()) return 0;
    return $this->custFixo()->salarioBruto();
  }

  public function consultor()
  {
    return $this->servicioConsultor->consultor;
  }

}