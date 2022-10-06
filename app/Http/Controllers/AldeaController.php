<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Aldea;

class AldeaController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function inicio()
    {
        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
        
        return  view('aldeas')->with('aldeas',$aldeas);
    }
}
     