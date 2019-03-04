<?php

namespace App\Src\Services;

use App\Src\Repositories\CustFixoRepo;

class CustoFixoMedio
{
	public function __construct()
	{
		$this->custFixoRepo = new CustFixoRepo();
	}

	public function handle($consultoresIds)
	{
		$custoFixos = $this->custFixoRepo->getContainsInto($consultoresIds);
		$custoFixosCount = $custoFixos->count();
		if(!$custoFixosCount) return 0;
		return $custoFixos->sum('brut_salario') / $custoFixosCount;
	}
}