<?php

namespace App\Src\Models;

class IntervaloData
{
	protected $fromDate;
	protected $toDate;

	public function __construct($fromDate, $toDate)
	{
		$this->fromDate = $fromDate;
		$this->toDate = $toDate;
	}

	public function from()
	{
		return $this->fromDate;
	}

	public function to()
	{
		return $this->toDate;
	}
}