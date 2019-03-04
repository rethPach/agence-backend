<?php

namespace App\Src\UseCases;

use App\Src\UseCases\Commands\FaturasConsultorCommand;
use App\Src\Repositories\FaturaRepo;
use App\Src\Services\FaturasConsultorEmpresa;

class FaturasConsultorHandler
{
	protected $faturaRepo;

	public function __construct()
	{
		$this->faturaRepo = new FaturaRepo();
	}

	public function handle(FaturasConsultorCommand $command)
	{
		$faturas = $this->faturas($command)->map(function($fatura) {
			return $fatura->calculate();
		});

		return $this->faturasConsultorEmpresa($faturas);
	}

	public function groupFacturas($faturas)
	{
		return $faturas->reduce(function($group, $fatura) {

			$cliente = $fatura['cliente_no_razao'];

			if(!array_key_exists($cliente, $group)) $group[$cliente] = [];

			array_push($group[$cliente], $fatura);

			return $group;

		}, []);
	}

	public function faturasConsultorEmpresa($faturas)
	{
		$groupFacturas = collect($this->groupFacturas($faturas));		

		return $groupFacturas->map(function($group, $key) {
			$faturaConsultorEmpresa = new FaturasConsultorEmpresa($key, $group);
			return $faturaConsultorEmpresa->toArray();
		})

		->values();
	}

	protected function faturas($command)
	{
		return $this->faturaRepo->getAllByConsultantAndTimeFrameSingle(
			$command->co_usuario(), 
			$command->time_frame()
		);
	}

}