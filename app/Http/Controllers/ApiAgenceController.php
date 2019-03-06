<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Src\Models\IntervaloData;
use App\Src\UseCases\Commands\FaturasConsultorCommand;
use App\Src\UseCases\Commands\DesempenoConsultoresCommand;
use App\Src\UseCases\FaturasConsultorHandler;
use App\Src\UseCases\DesempenoConsultores;
use App\Src\UseCases\ListadoConsultores;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiAgenceController extends Controller
{
	public function __construct()
	{
		$this->faturasConsultorHandler = new FaturasConsultorHandler();
    $this->desempenoConsultores = new DesempenoConsultores();
    $this->listadoConsultores = new ListadoConsultores();
	}

	  public function listadoConsultores()
    {
      $response = $this->listadoConsultores->all();
      return $this->getCustomResponse(1000, "Todo Cool",  $response);
    }

    public function listadoConsultoresGetByType(Request $request)
    {
      $consultoresType = [1];
      $response =  $this->listadoConsultores->getByType($consultoresType); 
      return $this->getCustomResponse(1000, "Todo Cool",  $response);
    }

    public function faturasConsultor(Request $request)
    {
        $usuarios = json_decode($request->get('co_usuarios'));
        $intervaloData = new IntervaloData($request->get('from'), $request->get('to'));
        $command = new FaturasConsultorCommand($usuarios, $intervaloData);
        $response = $this->faturasConsultorHandler->handle($command);

        return $this->getCustomResponse(1000, "Todo Cool",  $response);
    }

    public function desempenoConsultores(Request $request)
    {
      $usuarios = json_decode($request->get('co_usuarios'));
      $intervaloData = new IntervaloData($request->get('from'), $request->get('to'));
      $command = new DesempenoConsultoresCommand($usuarios, $intervaloData);
      $response = $this->desempenoConsultores->handle($command);

      return $this->getCustomResponse(1000, "Todo Cool",  $response); 
    }
}