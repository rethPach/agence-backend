<?php

namespace App\Src\UseCases\Commands;

class FaturasConsultorCommand
{
	
	protected $co_usuarios;
	protected $time_frame;

	public function __construct($co_usuarios, $time_frame)
	{
		$this->co_usuarios = $co_usuarios;
		$this->time_frame = $time_frame;
		
	}

	public function co_usuarios()
	{
		return $this->co_usuarios;
	}

	public function time_frame()
	{
		return $this->time_frame;
	}
}