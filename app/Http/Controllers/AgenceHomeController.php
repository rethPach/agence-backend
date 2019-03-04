<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \View;

class AgenceHomeController extends Controller
{
	public function __construct()
	{

	}

	public function index()
	{
		return View::make('welcome');
	}
}