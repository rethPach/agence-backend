<?php

namespace App\Src\UseCases;

use App\Src\UseCases\Commands\FaturasConsultorCommand;
use App\Src\Repositories\FaturaRepo;
use App\Src\Services\GrupoFaturas;

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

		return $this->groupFacturas($faturas);
	}

	public function groupFacturas($faturas)
	{
		$grupoFacturas = $faturas->reduce(function($group, $fatura) {
			$group->add($fatura);
			return $group;
		}, new GrupoFaturas());

		return $grupoFacturas->getResult();
	}

	protected function faturas($command)
	{
		return $this->faturaRepo->byFacturasConsultorHandler(
			$command->co_usuarios(), 
			$command->time_frame()
		);
	}

}