<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class VacasController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth');
    }
    public function inicio()
    {
        $idUsu =auth()->id();
        $aldeas_usuario = DB::table('aldea')->where('id_cuenta',$idUsu)->get();
        //print_r ($aldeas_usuario);
        $vacio ='no';
        return  view('vacas')->with('aldeas',$aldeas_usuario)->with('estado',$vacio);
    } 
    public function calculovacas(request $info)
    {
        
        $busqueda = [
            "aldeaLanza" => $info->idAldea,
            "dias" => $info->dias,
            "distancia" => $info->distancia,
            "cambiopob" => $info->poblacion,
            "minpob" =>$info->pobAldeas,
        ];

        $idUsu =auth()->id();
        $aldeas_usuario = DB::table('aldea')->where('id_cuenta',$idUsu)->get();
        $dias = ($info->dias)-1;
        $info_usu = DB::table('users')->select('servidor')->where('id',$idUsu)->get();
        $vacio ='si';

         foreach($info_usu as $s)
        {
            $idserver = $s->servidor;
        }
          $query = "SELECT distinct  CASE
        WHEN cinac.raza = 1 THEN 'Romana'
        WHEN cinac.raza = 2 THEN 'Germana'
        WHEN cinac.raza = 3 THEN 'Gala'
        WHEN cinac.raza = 4 THEN 'Naturaleza'
        WHEN cinac.raza = 5 THEN 'Natares'
            END as raza, aliinac.NombreAlianza,(select servidor.ruta from servidor where servidor.id = ".$idserver.") as rutaServer, cinac.idCuenta, cinac.NombreCuenta, ainac.NombreAldea ,aliinac.idAlianza,INFO_FINAL.distancia,INFO_FINAL.id_aldea,INFO_FINAL.poblacionActual,INFO_FINAL.id_server,
            INFO_FINAL.coord_x,INFO_FINAL.coord_y,INFO_FINAL.poblacion, INFO_FINAL.poblacionActual-INFO_FINAL.poblacion as difpob FROM 
            (select aldeas.*, ald2.poblacion from (SELECT calcular_distancia((SELECT coord_x FROM `aldea` where id =".$info->idAldea."), 
            (SELECT coord_y FROM `aldea` where id = ".$info->idAldea."), ald.coord_x, ald.coord_y) AS distancia, ald.IdAldea as id_aldea, ald.poblacion as poblacionActual, s.id as id_server, ald.coord_x, 
            ald.coord_y,s.fch_mod fecha_server FROM alianza_inac ali, cuenta_inac c, aldea_inac ald, servidor s WHERE ali.IdAlianza = c.IdAlianza AND c.IdCuenta = ald.IdCuenta 
            AND ali.id_server = c.IdServer AND c.IdServer = ald.id_server AND s.id = ali.id_server AND s.fch_mod = ald.updated_at AND s.id =  ".$idserver.") aldeas , aldea_inac ald2 
            where aldeas.distancia <  ".$info->distancia." and ald2.id_server = aldeas.id_Server and ald2.IdAldea = aldeas.id_aldea and ald2.updated_at = DATE_ADD(aldeas.fecha_server, INTERVAL - ".$dias." DAY)) 
            INFO_FINAL, aldea_inac ainac , cuenta_inac cinac, alianza_inac aliinac where (INFO_FINAL.poblacionActual-INFO_FINAL.poblacion) <".$info->poblacion." and INFO_FINAL.poblacionActual > ".$info->pobAldeas." and 
            INFO_FINAL.id_aldea not  in (SELECT idAldeaVaca FROM `lista_vacas` where IdAldea = ".$info->idAldea." and idServer =  ".$idserver.")
        and ainac.IdAldea = INFO_FINAL.id_aldea
        and ainac.id_server = INFO_FINAL.id_server
        and ainac.updated_at = (select servidor.fch_mod from servidor where servidor.id = ".$idserver.")
        and cinac.IdServer = ainac.id_server
        and cinac.IdCuenta = ainac.IdCuenta
        and aliinac.id_server = ainac.id_server
        and aliinac.updated_at = ainac.updated_at
        and cinac.IdAlianza =  aliinac.IdAlianza
        and cinac.raza <>5
        and cinac.idcuenta  in (select idCuenta from (SELECT `IdCuenta`,`IdServer`,`IdAlianza`,`NombreCuenta`,`Raza`, (SELECT sum(poblacion) FROM aldea_inac WHERE created_at = 
        (select fch_mod from servidor where id = ".$idserver.") and aldea_inac.IdCuenta = c.IdCuenta) as poblacion_hoy, (SELECT sum(poblacion) FROM aldea_inac 
        WHERE created_at =DATE_SUB((select fch_mod from servidor where id =  ".$idserver."),INTERVAL  ".$dias." DAY) and aldea_inac.IdCuenta = c.IdCuenta) as poblacion_antes FROM servidor 
        Ser, cuenta_inac c where c.IdServer = Ser.id and Ser.id = ".$idserver." ) cuentas where cuentas.poblacion_hoy - poblacion_antes<".$info->poblacion.")  
        ORDER BY `INFO_FINAL`.`distancia`  ASC;";
        //echo $query;
        $aldeas=DB::select($query);
        //print_r ($aldeas);
        return  view('vacas')->with('info',$aldeas)->with('estado',$vacio)->with('aldeas',$aldeas_usuario)->with('busqueda',$busqueda);
    } 
    
    public function listaVacas()
    {
        $idUsu =auth()->id() ;
        $query = 'SELECT distinct aldea_inac.poblacion, servidor.ruta,aldea.nombre as nombreLanza,cuenta_inac.IdCuenta as idcuentavaca, alianza_inac.IdAlianza AS alivaca,  aldea_inac.NombreAldea as nombrealdeaVaca,  aldea.coord_x as aldeaLanzax, aldea_inac.coord_x as vacax, aldea_inac.coord_y as vacay, aldea.coord_y as aldeaLanzay,cuenta_inac.NombreCuenta as cuentaVaca,alianza_inac.NombreAlianza as alianzaVaca, lista_vacas.created_at FROM `lista_vacas`, servidor, users, aldea, aldea_inac, cuenta_inac, alianza_inac
        where  lista_vacas.IdServer = servidor.id
        and users.servidor = servidor.id
        and aldea.id_cuenta = users.id
        and aldea.id = lista_vacas.IdAldea
        and aldea_inac.id_server = servidor.id
        and aldea_inac.idAldea = lista_vacas.IdAldeaVaca
        and aldea_inac.created_at = servidor.fch_mod
        and cuenta_inac.IdCuenta = aldea_inac.IdCuenta
        and cuenta_inac.IdServer = servidor.id
        and alianza_inac.id_Server = servidor.id
        and alianza_inac.IdAlianza = cuenta_inac.IdAlianza
        and users.id = '.$idUsu;

        $info=DB::select($query);
        //print_r ($info);
        return  view('LVacas')->with('info',$info);
    }
    
    public function insertarVacas(request $info)
    {
        $busqueda = [
            "aldeaLanza" => $info->idAldea,
            "dias" => $info->dias,
            "distancia" => $info->distancia,
            "cambiopob" => $info->cambioPob,
            "minpob" =>$info->minPob,
        ];


        $idUsu =auth()->id();
        $aldeas_usuario = DB::table('aldea')->where('id_cuenta',$idUsu)->get();
        $dias = ($info->dias)-1;
        $info_usu = DB::table('users')->select('servidor')->where('id',$idUsu)->get();
        $vacio ='si';

         foreach($info_usu as $s)
        {
            $idserver = $s->servidor;
        }
        $sql = "INSERT INTO `lista_vacas` ( `IdAldea`, `IdServer`, `IdAldeaVaca`, `created_at`, `updated_at`) VALUES ( '".$info->idAldea."', '".$idserver."', '".$info->idAldeaVaca."', current_date(), current_date())";
        $resultado=DB::select($sql);
        $query = "SELECT distinct  CASE
        WHEN cinac.raza = 1 THEN 'Romana'
        WHEN cinac.raza = 2 THEN 'Germana'
        WHEN cinac.raza = 3 THEN 'Gala'
        WHEN cinac.raza = 4 THEN 'Naturaleza'
        WHEN cinac.raza = 5 THEN 'Natares'
            END as raza, aliinac.NombreAlianza,(select servidor.ruta from servidor where servidor.id = ".$idserver.") as rutaServer, cinac.idCuenta, cinac.NombreCuenta, ainac.NombreAldea ,aliinac.idAlianza,INFO_FINAL.distancia,INFO_FINAL.id_aldea,INFO_FINAL.poblacionActual,INFO_FINAL.id_server,
            INFO_FINAL.coord_x,INFO_FINAL.coord_y,INFO_FINAL.poblacion, INFO_FINAL.poblacionActual-INFO_FINAL.poblacion as difpob FROM 
            (select aldeas.*, ald2.poblacion from (SELECT calcular_distancia((SELECT coord_x FROM `aldea` where id =".$info->idAldea."), 
            (SELECT coord_y FROM `aldea` where id = ".$info->idAldea."), ald.coord_x, ald.coord_y) AS distancia, ald.IdAldea as id_aldea, ald.poblacion as poblacionActual, s.id as id_server, ald.coord_x, 
            ald.coord_y,s.fch_mod fecha_server FROM alianza_inac ali, cuenta_inac c, aldea_inac ald, servidor s WHERE ali.IdAlianza = c.IdAlianza AND c.IdCuenta = ald.IdCuenta 
            AND ali.id_server = c.IdServer AND c.IdServer = ald.id_server AND s.id = ali.id_server AND s.fch_mod = ald.updated_at AND s.id =  ".$idserver.") aldeas , aldea_inac ald2 
            where aldeas.distancia <  ".$info->distancia." and ald2.id_server = aldeas.id_Server and ald2.IdAldea = aldeas.id_aldea and ald2.updated_at = DATE_ADD(aldeas.fecha_server, INTERVAL - ".$dias." DAY)) 
            INFO_FINAL, aldea_inac ainac , cuenta_inac cinac, alianza_inac aliinac where (INFO_FINAL.poblacionActual-INFO_FINAL.poblacion) <".$info->cambioPob." and INFO_FINAL.poblacionActual > ".$info->minPob." and 
            INFO_FINAL.id_aldea not  in (SELECT idAldeaVaca FROM `lista_vacas` where IdAldea = ".$info->idAldea." and idServer =  ".$idserver.")
        and ainac.IdAldea = INFO_FINAL.id_aldea
        and ainac.id_server = INFO_FINAL.id_server
        and ainac.updated_at = (select servidor.fch_mod from servidor where servidor.id = ".$idserver.")
        and cinac.IdServer = ainac.id_server
        and cinac.IdCuenta = ainac.IdCuenta
        and aliinac.id_server = ainac.id_server
        and aliinac.updated_at = ainac.updated_at
        and cinac.IdAlianza =  aliinac.IdAlianza
        and cinac.raza <>5
        and cinac.idcuenta  in (select idCuenta from (SELECT `IdCuenta`,`IdServer`,`IdAlianza`,`NombreCuenta`,`Raza`, (SELECT sum(poblacion) FROM aldea_inac WHERE created_at = 
        (select fch_mod from servidor where id = ".$idserver.") and aldea_inac.IdCuenta = c.IdCuenta) as poblacion_hoy, (SELECT sum(poblacion) FROM aldea_inac 
        WHERE created_at =DATE_SUB((select fch_mod from servidor where id =  ".$idserver."),INTERVAL  ".$dias." DAY) and aldea_inac.IdCuenta = c.IdCuenta) as poblacion_antes FROM servidor 
        Ser, cuenta_inac c where c.IdServer = Ser.id and Ser.id = ".$idserver." ) cuentas where cuentas.poblacion_hoy - poblacion_antes<".$info->cambioPob.")  
        ORDER BY `INFO_FINAL`.`distancia`  ASC;";
        //echo $query;
        $aldeas=DB::select($query);
        //print_r ($aldeas);
        return  view('vacas')->with('info',$aldeas)->with('estado',$vacio)->with('aldeas',$aldeas_usuario)->with('busqueda',$busqueda);
        //print_r ($busqueda);
        //return  view('vacas')->with('info',$aldeas)->with('estado',$vacio)->with('aldeas',$aldeas_usuario)->with('busqueda',$busqueda);
    }
}
