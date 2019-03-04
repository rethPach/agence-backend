<?php

namespace App\Src\Models\Fatura;


class ConsultantFinder
{
	public static function findByInvoice(InvoiceEntitie $entitie)
	{
		return $entitie->consultantService->consultant;
	}
}