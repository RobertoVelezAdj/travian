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
    public function generadorAldea(request $info)
    {   
        $idUsu =auth()->id();
        //echo $info->fiesta_pequena;
        $query = "INSERT INTO aldea ( coord_x, coord_y, nombre, puntos_cultura, madera, barro, hierro, cereal, id_cuenta, tipo, fiesta_grande, fiesta_pequena, created_at, updated_at) VALUES ( '".$info->coord_x."', '".$info->coord_y."', '".$info->nombreAldea."', '".$info->puntos_cultura."', '".$info->madera."', '".$info->barro."', '".$info->hierro."', '".$info->cereal."', '".$idUsu."', '".$info->tipo."', '".$info->fiesta_grande."', '".$info->fiesta_pequena."', current_date(), current_date());";
        $aldeas=DB::select($query);
        //$dias = ($info->dias)-1;
        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
        
        return  view('aldeas')->with('aldeas',$aldeas);
    }
    public function borrarAldea(request $info)
    {   
        $query = "DELETE FROM aldea WHERE id =".$info->idAldea." ;";
        $aldea=DB::select($query);
        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
        
        return  view('aldeas')->with('aldeas',$aldeas);
    }
    public function editarAldea(request $info)
    {   
        $query = "UPDATE aldea SET tipo = '".$info->tipo."', nombre = '".$info->nombreAldea."' , puntos_cultura = ".$info->puntos_cultura.",madera = ".$info->madera.", barro = ".$info->barro.", hierro = ".$info->hierro.", cereal = ".$info->cereal.", fiesta_grande = ".$info->fiesta_grande.",fiesta_pequena = ".$info->fiesta_pequena." WHERE id = ".$info->idAldea.";";

        $aldea=DB::select($query);
        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
        
        return  view('aldeas')->with('aldeas',$aldeas);
    }
    public function verTareas()
    {    
        
        $idUsu =auth()->id();
        $query = "SELECT t.id as id_tarea,prioridad,a.nombre, t.id_aldea,  t.id_cuenta, titulo,texto, t.created_at,t.updated_at,estado FROM `tareas` t, aldea a WHERE t.estado = 0 and a.id = t.id_aldea and t.id_cuenta = ".$idUsu." order by id_aldea, prioridad,created_at;";
        $tareas=DB::select($query);

        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
         
        return  view('tareas')->with('tareas',$tareas)->with('aldeas',$aldeas);
    }
    public function nuevaTarea(request $info)
    {    
        $idUsu =auth()->id();
        $query = "INSERT INTO tareas (prioridad, id_aldea, id_cuenta, Titulo, Texto, created_at, updated_at, Estado) VALUES ( '".$info->prioridad."', '".$info->id_aldea."',".$idUsu .", '".$info->titulo."', '".$info->Descripcion."', current_date(), current_date(), '0');";
        $t=DB::select($query);
        
        $query = "SELECT t.id  as id_tarea,prioridad,a.nombre, t.id_aldea,  t.id_cuenta, titulo,texto, t.created_at,t.updated_at,estado FROM `tareas` t, aldea a WHERE t.estado = 0 and a.id = t.id_aldea and t.id_cuenta = ".$idUsu." order by id_aldea, prioridad,created_at;";
        $tareas=DB::select($query);

        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
         
        return  view('tareas')->with('tareas',$tareas)->with('aldeas',$aldeas);
    }
    
    public function completarTarea(request $info)
    {    
        $idUsu =auth()->id();
        
        //echo $info->id_tarea;
        
        $query = "UPDATE `tareas` SET Estado = '1' WHERE id = ".$info->id_tarea.";";
        $tareas=DB::select($query);
        $query = "SELECT t.id  as id_tarea,prioridad,a.nombre, t.id_aldea,  t.id_cuenta, titulo,texto, t.created_at,t.updated_at,estado FROM `tareas` t, aldea a WHERE t.estado = 0 and a.id = t.id_aldea and t.id_cuenta = ".$idUsu." order by id_aldea, prioridad,created_at;";
        $tareas=DB::select($query);

        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
         
        return  view('tareas')->with('tareas',$tareas)->with('aldeas',$aldeas);
    }
    public function editarTarea(request $info)
    {    
        $idUsu =auth()->id();
                
        $query = "UPDATE `tareas` SET prioridad = '".$info->prioridad."' WHERE id = ".$info->idTarea.";";
        //echo $query;
        $tareas=DB::select($query);
        $query = "SELECT t.id  as id_tarea,prioridad,a.nombre, t.id_aldea,  t.id_cuenta, titulo,texto, t.created_at,t.updated_at,estado FROM `tareas` t, aldea a WHERE t.estado = 0 and a.id = t.id_aldea and t.id_cuenta = ".$idUsu." order by id_aldea, prioridad,created_at;";
        $tareas=DB::select($query);

        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
         
        return  view('tareas')->with('tareas',$tareas)->with('aldeas',$aldeas);
    }
    public function edificios(request $info)
    {    
        $idUsu =auth()->id();
        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get(); 
        return  view('edificios')->with('aldeas',$aldeas);
    }
    public function edificioseditar(request $info)
    {    
        
        $query = "UPDATE aldea SET cuartel = '".$info->cuartel."', establo = ".$info->establo." , establo_g = ".$info->establo_g.", cuartel_g = '".$info->cuartel_g."' , taller = ".$info->taller.",ayuntamiento = ".$info->ayuntamiento.", p_torneos = ".$info->p_torneos.", o_comercio = ".$info->o_comercio."  WHERE id = ".$info->idAldea.";";
        //echo $query;
        $aldea=DB::select($query);
        $aldeas = DB::table('aldea')->where('id_cuenta','=',auth()->user()->id)->get();
        
        return  view('edificios')->with('aldeas',$aldeas);
    }
    
    
}
     