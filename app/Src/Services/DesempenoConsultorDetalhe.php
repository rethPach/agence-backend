<?php

namespace App\Src\Services;

class DesempenoConsultorDetalhe
{
	
	public function __construct()
	{
		
	}

	public function handle($faturas, $custoFixoMedio)
	{
		$desempenos = $this->addYears(
			$this->addMonths(
				$this->addFacturas(
					$this->agruparFaturas($faturas)
				)
			)
		);

		return [
			"custo_fixo_medio"=>$custoFixoMedio,
			"desempenos"=>$desempenos 
		];
	}


	protected function agruparFaturas($faturas)
	{
		return $faturas->reduce(function($grupoFaturas, $fatura) {

			$no_usuario = $fatura['consultor_no_usuario'];
			$year = $fatura['data_emissao_ano'];
			$month = $fatura['data_emissao_mes'];

			if(!array_key_exists($no_usuario, $grupoFaturas)) $grupoFaturas[$no_usuario] = [];
			if(!array_key_exists($year, $grupoFaturas[$no_usuario])) $grupoFaturas[$no_usuario][$year] = [];
			if(!array_key_exists($month, $grupoFaturas[$no_usuario][$year])) $grupoFaturas[$no_usuario][$year][$month] = [];

			array_push($grupoFaturas[$no_usuario][$year][$month], $fatura);

			return $grupoFaturas;

		}, []);
	}

	protected function addYears($grupoFaturas)
	{
		foreach ($grupoFaturas as $consultorKey => $years) {
				$yearsCollect = collect($years);
			 	$grupoFaturas[$consultorKey]= [
			 		"name"=>$consultorKey,
			 		"sum_receita_liquida" => $yearsCollect->sum('sum_receita_liquida'),
				 	"sum_comissao" => $yearsCollect->sum('sum_comissao'),
				 	"sum_custo_fixo" => $yearsCollect->sum('sum_custo_fixo'),
				 	"sum_lucro" => $yearsCollect->sum('sum_lucro'),
				 	"years" => $yearsCollect->values()
			 	];
		}

		return collect($grupoFaturas)->values();
	}

	protected function addMonths($grupoFaturas)
	{
		foreach ($grupoFaturas as $consultorKey => $consultores) {
			foreach ($consultores as $yearKey => $months) {
					if(!array_key_exists($consultorKey, $grupoFaturas)) $grupoFaturas[$consultorKey] = [];
					
					$monthsCollect = collect($months);

				 	$grupoFaturas[$consultorKey][$yearKey] = [
				 		"name"=>$yearKey,
				 		"sum_receita_liquida" => $monthsCollect->sum('sum_receita_liquida'),
					 	"sum_comissao" => $monthsCollect->sum('sum_comissao'),
					 	"sum_custo_fixo" => $monthsCollect->sum('sum_custo_fixo'),
					 	"sum_lucro" => $monthsCollect->sum('sum_lucro'),
					 	"months" => $monthsCollect->values()
				 	];
			}
		}

		return $grupoFaturas;
	}

	protected function addFacturas($grupoFaturas)
	{
		foreach ($grupoFaturas as $consultorKey => $consultores) {
			foreach ($consultores as $yearKey => $years) {
				foreach ($years as $monthKey => $faturas) {

					if(!array_key_exists($consultorKey, $grupoFaturas)) $grupoFaturas[$consultorKey] = [];
					if(!array_key_exists($yearKey, $grupoFaturas[$consultorKey])) $grupoFaturas[$consultorKey][$yearKey] = [];

					$facturaCollect = collect($faturas);

				 	$grupoFaturas[$consultorKey][$yearKey][$monthKey] = [
				 		"name"=>$monthKey,
				 		"periodo"=>$this->periodo($monthKey, $yearKey),
				 		"sum_receita_liquida" => $facturaCollect->sum('receita_liquida'),
					 	"sum_comissao" => $facturaCollect->sum('comissao'),
					 	"sum_custo_fixo" => $facturaCollect->sum('custo_fixo'),
					 	"sum_lucro" => $facturaCollect->sum('lucro'),
					 	"facturas" => $faturas
				 	];
				}
			}
		}

		return $grupoFaturas;
	}

	protected function periodo($month, $year)
	{
		$dt = \DateTime::createFromFormat('!m', $month);
		return $dt->format('F').' of '.$year;
	}
}