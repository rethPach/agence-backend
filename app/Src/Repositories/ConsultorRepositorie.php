<?php

namespace App\Src\Repositories;

use App\Src\Models\Consultor;

class ConsultorRepositorie
{
	public function all()
	{
		return $this->getByTypes([0,1,2]);
	}

	public function getByTypes($types)
	{
		$query = Consultor::whereHas('permissaoSistema', function($qb) use($types){
			$qb
			->where('co_sistema', 1)
			->where('in_ativo', 'S')
			->whereIn('co_tipo_usuario', $types);
		});

		$query->with('permissaoSistema');

		return $query->get();
	}

	public function getByType($type)
	{
		$query = Consultor::whereHas('permissaoSistema', function($qb) use($type){
			$qb
			->where('co_sistema', 1)
			->where('in_ativo', 'S')
			->where('co_tipo_usuario', $type);
		});

		$query->with('permissaoSistema');

		return $query->get();
	}
}