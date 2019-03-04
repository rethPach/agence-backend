<?php

namespace App\Src\Models;

use Illuminate\Database\Eloquent\Model; 

class Cliente extends Model
{
	protected $table = 'cao_cliente';

 	protected $fillable = [
 		"co_cliente",
    "no_razao",
    "no_fantasia"
  ];
}