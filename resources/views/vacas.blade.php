<x-app-layout>
<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" ></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.colVis.min.js" ></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div>{{ __('Vacas  ') }}</div>
        </h2>
      
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       
                
            @if($estado =='no')
            <h1>Búsqueda de vacas</h1>
            <form action="/vacas/calculovacas"  action="{{'submit'}}" method="post">
                @method('PUT')
                @csrf
             
                <input type="hidden" name="_method" value="PUT">
                    <div class="mb-3">
                    <label class="form-label">Aldea lanzamiento</label>
                    
                    <select class="form-select" aria-label="Default select example" name = "idAldea">
                            @foreach($aldeas as $aldea)
                               
                                    <option value="{{$aldea->id}}">{{$aldea->nombre}}</option>                    
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Días desde el cambio</label>
                        <input name="dias" type="number" min="2" pattern="^[0-9]+" class="form-control"  >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Max distancia</label>
                        <input name="distancia" type="number" min="2" pattern="^[0-9]+" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Max cambio de poblacion</label>
                        <input name="poblacion" type="number" min="1" pattern="^[0-9]+" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mínima población de aldeas</label>
                        <input name="pobAldeas" type="number" min="0" pattern="^[0-9]+" class="form-control" >
                    </div>
                   <button type="submit" class="btn btn-primary">Búsqueda</button>
                </form> 
            @else
         
            <h1>Búsqueda de vacas</h1>
                <form action="/vacas/calculovacas"  action="{{'submit'}}" method="post">
                            @method('PUT')
  @csrf
                    <div class="mb-3">
                    <label class="form-label">Aldea lanzamiento</label>
                    <select class="form-select" aria-label="Default select example" name = "idAldea">
                        @foreach($aldeas as $aldea){
                            @if($aldea->id==$busqueda['aldeaLanza'])
                                <option value='{{$aldea->id}}' selected = 'selected'>{{$aldea->nombre}}</option>
                            @else
                                <option value='{{$aldea->id}}' >{{$aldea->nombre}}</option>
                            @endif    
                        @endforeach      
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Días desde el cambio</label>
                        <input name="dias" type="number" min="2" pattern="^[0-9]+" class="form-control" value = "{{$busqueda['dias']}}" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Max distancia</label>
                        <input name="distancia" type="number" min="2" pattern="^[0-9]+" class="form-control"  value = "{{$busqueda['distancia']}}" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Max cambio de poblacion</label>
                        <input name="poblacion" type="number" min="1" pattern="^[0-9]+" class="form-control" value = "{{$busqueda['cambiopob']}}" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mínima población de aldeas</label>
                        <input name="pobAldeas" type="number" min="0" pattern="^[0-9]+" class="form-control" value = "{{$busqueda['minpob']}}"  >
                    </div>
                   <button type="submit" class="btn btn-primary">Búsqueda</button>
                </form> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center ">
                    <div class="card-body "> 
                        
                    </div>  
                </div>
              
                    <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="card-body">
                                <table id="taldeas" class="table table-bordered table-striped table-responsive ">
                                    <thead>
                                            <tr>
                                                <th>Distancia</th>
                                                <th>Nombre aldea</th>
                                                <th>Cuenta</th>
                                                <th>Raza</th>
                                                <th>Nombre alianza</th>
                                                <th>Población</th> 
                                                <th>Diferencia población</th> 
                                                <th>Opciones</th>                        
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($info as $posibleVacas)
                                        <tr>
                                                <td>{{$posibleVacas->distancia}}  </td>
                                                <td>{{$posibleVacas->NombreAldea}} <a target="_blank" href="{{$posibleVacas->rutaServer}}/position_details.php?x={{$posibleVacas->coord_x}}&y={{$posibleVacas->coord_y}}"   >{{$posibleVacas->coord_x }}{{ __('/') }}{{$posibleVacas->coord_y }}</a></td>
                                                <td><a target="_blank" href="{{$posibleVacas->rutaServer}}/profile/{{$posibleVacas->idCuenta}}" >{{$posibleVacas->NombreCuenta}} </a></td>
                                                <td>{{$posibleVacas->raza}}</td>
                                                <td><a target="_blank"  href="{{$posibleVacas->rutaServer}}/alliance/{{$posibleVacas->idAlianza}}">{{$posibleVacas->NombreAlianza}} </a> </td>
                                                <td>{{$posibleVacas->poblacionActual}}</td>
                                                <td>{{$posibleVacas->difpob}}</td>
                                                <td>
                                                    <form action="/vacas/insertarVacas"  action="{{'submit'}}" method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <button type="submit" class="btn btn-success float-right" >Añadir</button>
                                                        <input  name="idAldeaVaca" type="hidden" value="{{$posibleVacas->id_aldea}}">
                                                        <input  name="idAldea" type="hidden" value="{{$busqueda['aldeaLanza']}}">
                                                        <input  name="dias" type="hidden" value="{{$busqueda['dias']}}">
                                                        <input  name="distancia" type="hidden" value="{{$busqueda['distancia']}}">
                                                        <input  name="cambioPob" type="hidden" value="{{$busqueda['cambiopob']}}">
                                                        <input  name="minPob" type="hidden" value="{{$busqueda['minpob']}}">
                                                    </form>
                                                 </td>
                                        </tr>   
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        $(function () {
                $('#taldeas').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            });

        });
    </script>

</x-app-layout>
