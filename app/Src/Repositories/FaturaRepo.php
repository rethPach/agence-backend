<?php

namespace App\Src\Repositories;

use App\Src\Models\Fatura\FaturaEntity;
use App\Src\Models\Fatura\Fatura;

class FaturaRepo
{
	public function byFacturasConsultorHandler($co_usuarios, $timeFrame)
	{
		$invoicesQueryBuilder = FaturaEntity::whereHas('servicioConsultor', function($query) use($co_usuarios){
  		$query->whereIn('co_usuario', $co_usuarios);
  	});

  	$invoicesQueryBuilder->whereBetween('data_emissao', [$timeFrame->from(), $timeFrame->to()]);

    $invoicesQueryBuilder->with('servicioConsultor.consultor.custFixo', 'sistema', 'cliente');

    return $invoicesQueryBuilder->get()->map(function($entitie) {
      return new Fatura($entitie);
    });
	}

	public function byDesempenoConsultores($co_usuarios, $timeFrame)
	{
		$invoicesQueryBuilder = FaturaEntity::whereHas('servicioConsultor', function($query) use($co_usuarios){
  		$query->whereIn('co_usuario', $co_usuarios);
  	});

  	$invoicesQueryBuilder->whereBetween('data_emissao', [$timeFrame->from(), $timeFrame->to()]);

    $invoicesQueryBuilder->with('servicioConsultor.consultor.custFixo', 'sistema');

    return $invoicesQueryBuilder->get()->map(function($entitie) {
      return new Fatura($entitie);
    });
	}
}