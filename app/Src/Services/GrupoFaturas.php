<?php

namespace App\Src\Services;

class GrupoFaturas
{
	protected $consultores;

	public function __construct()
	{
		$this->consultores = collect();
	}

	public function add($fatura)
	{
		$consultor = $this->addConsultor($fatura);
		$cliente = $this->addCliente($consultor, $fatura);
		$this->addFatura($cliente, $fatura);
	}

	protected function addConsultor($fatura)
	{
		
		$consultorX = $this->findCollection($this->consultores, 'name', $fatura['consultor_co_usuario']);

		if(!$consultorX) {

			$consultorX = [
				'name'=>$fatura['consultor_co_usuario'],
				'clientes'=>collect()
			];

			$this->consultores->push($consultorX);
		}

		return $consultorX;
	}

	protected function addCliente($consultor, $fatura)
	{
		$clientes = $consultor['clientes'];

		$clienteX = $this->findCollection($clientes, 'name', $fatura['cliente_no_razao']);

		if(!$clienteX) {

			$clienteX = [
				'name'=> $fatura['cliente_no_razao'],
				'faturas'=>collect()
			];

			$clientes->push($clienteX);
		}

		return $clienteX;
	}

	protected function addFatura($cliente, $fatura)
	{
		$faturas = $cliente['faturas'];

		$faturas->push($fatura);
	}

	public function getResult()
	{
		return $this->consultores->map(function($consultor) {
			$clientes = $consultor['clientes'];
			
			$consultor['clientes'] = $clientes->map(function($cliente) {
				$faturas = $cliente['faturas'];
				$cliente['sum_valor'] = $faturas->sum('valor');
				$cliente['sum_comissao'] = $faturas->sum('comissao');
				$cliente['sum_receita_liquida'] = $faturas->sum('receita_liquida');
				return $cliente;
			});

			return $consultor;
		});
	}

	public function findCollection($collection, $attr, $value)
	{
		return $collection->first(function($key, $item) use($attr, $value){
			return $item[$attr] == $value;
		});
	}

}