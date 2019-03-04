<?php

namespace App\Src\Models\Fatura;


class BuscadorCustFixo
{
	public static function findByInvoice(Invoice $invoice)
	{
		$fixedCost = $invoice->consultantService->consultant->fixedCost;
		return $fixedCost->netSalary();
	}
}