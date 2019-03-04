<?php

namespace App\Src\Models\Fatura;

use App\Src\Models\Consultor;
use App\Src\Models\ServicioConsultor;

class Fatura
{
	protected $entity;
	protected $num_nf;
	protected $valor;
	protected $comissao_cn;
	protected $total_imp_inc;
 	protected $consultor;
 	protected $consultor_no_usuario;
 	protected $consultor_co_usuario;
 	protected $cliente;
 	protected $cliente_co_cliente;
 	protected $cliente_no_razao;
 	protected $cliente_no_fantasia;
 	protected $sistema;
 	protected $sistema_no_sistema;
 	protected $servicio_consultor;
 	protected $servicio_consultor_ds_os;
 	protected $servicio_consultor_ds_ca;
 	protected $receita_liquida;
 	protected $comissao;
 	protected $custo_fixo;
 	protected $lucro;
 	protected $data_emissao;
 	protected $data_emissao_ano;
 	protected $data_emissao_mes;

	public function __construct(FaturaEntity $entity)
	{
		$this->entity = $entity;
	}

	public function __get($attr)
	{
		return $this->entity[$attr];
	}

	protected function setConsultor()
	{
		$this->consultor = $this->entity->consultor();
		$this->consultor_no_usuario = $this->consultor->no_usuario;
		$this->consultor_co_usuario = $this->consultor->co_usuario;
	}

	protected function setCliente()
	{
		$cliente = $this->entity->cliente;
		$this->cliente = $cliente;
		$this->cliente_co_cliente = $cliente->co_cliente;
		$this->cliente_no_razao = $cliente->no_razao;
		$this->cliente_no_fantasia = $cliente->no_fantasia;
	}

	public function setSistema()
	{
		$this->sistema = $this->entity->sistema;
		$this->sistema_no_sistema = $this->sistema->no_sistema;
	}

	protected function setServicioConsultor()
	{
		$servicio_consultor = $this->entity->servicioConsultor;
		$this->servicio_consultor = $servicio_consultor;
		$this->servicio_consultor_ds_os = $servicio_consultor->ds_os;
		$this->servicio_consultor_ds_ca = $servicio_consultor->ds_caracteristica;
	}

	protected function setReceitaLiquida()
	{
		$valor = $this->entity->valor;
		$total_imp_inc = $this->entity->total_imp_inc/100;
		$this->receita_liquida = $valor - ($valor * $total_imp_inc);
	}

	protected function setComissao()
	{
		$comissao_cn = $this->entity->comissao_cn/100;
		$this->comissao = $this->receita_liquida * $comissao_cn;
	}

	protected function setCustoFixo()
	{
		$this->custo_fixo = $this->entity->salarioBrutoConsultor();
	}

	protected function setLucro()
	{
		$custo = $this->custo_fixo + $this->comissao;
		$this->lucro = $this->receita_liquida - $custo;
	}

	protected function setDataEmissao()
	{
		$this->data_emissao = $this->entity->data_emissao;
		$this->data_emissao_ano = date('Y',strtotime($this->data_emissao));
		$this->data_emissao_mes = date('n',strtotime($this->data_emissao));
	}

	protected function fillFromEntity()
	{
		$this->num_nf = $this->entity->num_nf;
		$this->valor = $this->entity->valor;
		$this->comissao_cn = $this->entity->comissao_cn;
		$this->total_imp_inc = $this->entity->total_imp_inc;
	}

	public function calculate()
	{
		$this->fillFromEntity();
		$this->setConsultor();
		$this->setSistema();
		$this->setServicioConsultor();
		$this->setReceitaLiquida();
		$this->setComissao(); 
		$this->setDataEmissao();
		$this->setCliente();
		
		return $this->toCalculate();
	}

	public function calculateFromPerformance()
	{
		$this->fillFromEntity();
		$this->setConsultor();
		$this->setSistema();
		$this->setServicioConsultor();
		$this->setReceitaLiquida();
		$this->setComissao(); 
		$this->setDataEmissao();
		$this->setCliente();
		$this->setCustoFixo();
		$this->setLucro();

		return $this->toCalculate();
	}

	public function toCalculate()
	{
		return [
			"num_nf" => $this->num_nf,
			"valor" => $this->valor,
			"comissao_cn" => $this->comissao_cn,
			"total_imp_inc" => $this->total_imp_inc,
		 	"consultor_no_usuario" => $this->consultor_no_usuario,
		 	"consultor_co_usuario" => $this->consultor_co_usuario,
		 	"cliente_co_cliente" => $this->cliente_co_cliente,
			"cliente_no_razao" => $this->cliente_no_razao,
			"cliente_no_fantasia" => $this->cliente_no_fantasia,
		 	"sistema_no_sistema" => $this->sistema_no_sistema,
		 	"servicio_consultor_ds_os" => $this->servicio_consultor_ds_os,
		 	"servicio_consultor_ds_ca" => $this->servicio_consultor_ds_ca,
		 	"receita_liquida" => $this->receita_liquida,
		 	"comissao" => $this->comissao,
		 	"custo_fixo" => $this->custo_fixo,
		 	"lucro" => $this->lucro,
		 	"data_emissao" => $this->data_emissao,
		 	"data_emissao_ano" => $this->data_emissao_ano,
		 	"data_emissao_mes" => $this->data_emissao_mes
		];
	}

}