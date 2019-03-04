<?php

namespace App\Src\UseCases\Commands;

class FaturasConsultorCommand
{
	
	protected $co_usuario;
	protected $time_frame;

	public function __construct($co_usuario, $time_frame)
	{
		$this->co_usuario = $co_usuario;
		$this->time_frame = $time_frame;
		
	}

	public function co_usuario()
	{
		return $this->co_usuario;
	}

	public function time_frame()
	{
		return $this->time_frame;
	}
}