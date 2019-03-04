<?php

namespace App\Src\UseCases;

use App\Src\UseCases\Commands\DesempenoConsultoresCommand;
use App\Src\Repositories\FaturaRepo;
use App\Src\Services\DesempenoConsultorDetalhe;
use App\Src\Services\CustoFixoMedio;

class DesempenoConsultores
{
	public function __construct()
	{
		$this->faturaRepo = new FaturaRepo();
		$this->desempenoConsultorDetalhe = new DesempenoConsultorDetalhe();
		$this->custoFixoMedio = new CustoFixoMedio();
	}

	public function handle(DesempenoConsultoresCommand $command)
	{
		$faturas = $this->faturas($command)->map(function($fatura) {
			return $fatura->calculateFromPerformance();
		});

		return $this->desempenoConsultorDetalhe->handle($faturas, $this->custoFixoMedio($command));
	}

	protected function custoFixoMedio($command)
	{
		return $this->custoFixoMedio->handle($command->co_usuarios());
	}

	protected function faturas($command)
	{
		return $this->faturaRepo->getAllByConsultantAndTimeFrameMulti(
			$command->co_usuarios(), 
			$command->time_frame()
		);
	}
}


