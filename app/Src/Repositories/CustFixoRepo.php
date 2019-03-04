<?php

namespace App\Src\Repositories;

use App\Src\Models\CustFixo;

class CustFixoRepo
{
	public function findByConsultantOrFail($co_usuario)
	{
		return CustFixo::where('co_usuario', $co_usuario)->firstOrFail();
	}

	public function getContainsInto($co_usuarios)
	{
		return CustFixo::whereIn('co_usuario', $co_usuarios)->get();
	}
}