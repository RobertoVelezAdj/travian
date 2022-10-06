<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConstruccionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function inicio()
    {
        $construcciones = DB::table('construcciones')->get();
        //echo $construcciones;
        return  view('construcciones')->with('construcciones',$construcciones);
    }
}
