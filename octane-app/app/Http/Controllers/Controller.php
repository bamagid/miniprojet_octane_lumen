<?php

namespace App\Http\Controllers;

abstract class Controller
{
   public function responseHeader($request){
    return header('Authorization','bearer '.$request->bearerToken());
   }
}
