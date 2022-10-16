<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusquedaVacas extends Component
{
    public function render()
    {
        $aldeas_usuario = DB::table('aldea')->where('id_cuenta',$idUsu)->get();
        return view('livewire.busqueda-vacas')->with('aldeas',$aldeas_usuario);
    }
}
