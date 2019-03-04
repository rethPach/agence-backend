<?php

namespace App\Src\UseCases;

use App\Src\Repositories\ConsultorRepositorie;

class ListadoConsultores
{
	public function __construct()
	{
		$this->ConsultorRepositorie = new ConsultorRepositorie();
	}

	public function all()
	{
		return $this->toResponse($this->ConsultorRepositorie->all());
	}

	public function getByType($type)
	{
		return $this->toResponse($this->ConsultorRepositorie->getByType($type));
	}

	protected function toResponse($consultores)
	{
		$consultores = $consultores->map(function($consultor) {
			return array_merge($consultor->toArray(), [
				"co_tipo_usuario"=>$consultor->permissaoSistema->co_tipo_usuario,
				"permissao_sistema"=>[]
			]);
		});

		return [
			"consultores" => $consultores,
			"types"=>$this->types()
		];
	}

	protected function types() 
	{
		return [
			["id"=>0, "name"=>"MS"],
			["id"=>1, "name"=>"SP"],
			["id"=>2, "name"=>"DF"]
		];
	}

}