<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class tropasController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth');
    }
    public function encole()
    {
        $idUsu =auth()->id();
        $aldeas_usuario = DB::table('aldea')->where('id_cuenta',$idUsu)->get();

        $query = "SELECT * FROM `tropas`, users WHERE tropas.raza = users.raza and users.id = ".$idUsu;
        $tropas=DB::select($query);

        return  view('encole')->with('aldeas',$aldeas_usuario)->with('tropas',$tropas);
    } 
  
   
}
