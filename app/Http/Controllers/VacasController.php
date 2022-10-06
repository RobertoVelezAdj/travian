<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VacasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function inicio()
    {
        //$construcciones = DB::table('vacas')->get();
        //echo $construcciones;
        return  view('vacas');
    } 
    public function cargaVacas()
    {
      
    }
}
