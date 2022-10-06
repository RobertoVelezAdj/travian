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
        $command = escapeshellcmd('python /var/www/vhosts/ keen-bell.82-223-29-115.plesk.page/http_docs/00-inactivos/guardar_paginaweb.py');
    }
}
