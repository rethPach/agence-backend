<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Src\Models\IntervaloData;
use App\Src\UseCases\Commands\FaturasConsultorCommand;
use App\Src\UseCases\FaturasConsultorHandler;
use App\Src\UseCases\Commands\DesempenoConsultoresCommand;
use App\Src\UseCases\DesempenoConsultores;
use App\Src\UseCases\ListadoConsultores;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function __construct()
    {
    	$this->faturasConsultorHandler = new FaturasConsultorHandler();
      $this->desempenoConsultores = new DesempenoConsultores();
      $this->listadoConsultores = new ListadoConsultores();
    }

    public function test()
    {
        return $this->getCustomResponse(1000, "Todo Cool", $this->testFaturasConsultorHandler());
    }

    protected function testListadoConsultores()
    {
      return $this->listadoConsultores->all();
    }

    protected function testListadoConsultoresGetByType()
    {
      $consultoresType = [1];
      return $this->listadoConsultores->getByType($consultoresType);
    }

    protected function testFaturasConsultorHandler()
    {
        $usuario = "carlos.carvalho";
        $intervaloData = new IntervaloData("2007-01-25", "2007-03-14");
        $command = new FaturasConsultorCommand($usuario, $intervaloData);

        return $this->faturasConsultorHandler->handle($command);
    }

    protected function testDesempenoConsultores()
    {
      $usuarios = ["carlos.carvalho", "carlos.arruda"];
      $intervaloData = new IntervaloData("2007-01-25", "2007-03-14");
      $command = new DesempenoConsultoresCommand($usuarios, $intervaloData);

      return $this->desempenoConsultores->handle($command);
    }

}
