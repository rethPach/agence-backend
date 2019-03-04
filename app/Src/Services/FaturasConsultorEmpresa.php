<?php

namespace App\Src\Services;

class FaturasConsultorEmpresa
{
	protected $faturas;
	protected $cliente_no_razao;
	protected $sum_valor;
	protected $sum_comissao;
	protected $sum_receita_liquida;

	public function __construct($cliente_no_razao, $faturaEmpresaGroup)
	{
		$this->faturas = collect($faturaEmpresaGroup);
		$this->cliente_no_razao = $cliente_no_razao;
		$this->sum_valor = $this->faturas->sum('valor');
		$this->sum_comissao = $this->faturas->sum('comissao');
		$this->sum_receita_liquida = $this->faturas->sum('receita_liquida');
	}

	public function toArray()
	{
		return [
			"cliente_no_razao"=>$this->cliente_no_razao,
			"sum_valor"=>$this->sum_valor,
			"sum_comissao"=>$this->sum_comissao,
			"sum_receita_liquida"=>$this->sum_receita_liquida,
			"faturas"=>$this->faturas
		];
	}
}