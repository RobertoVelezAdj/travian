<x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información de las aldeas') }}
        </h2>
    </x-slot>


    <div class="w-75 p-3 mx-auto sm:px-6 lg:px-8 text-center ">
        <div class="card-body "> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg> 
                Nueva aldea
            </button>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Nueva aldea</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form action="/aldeas/nueva" action="{{'submit'}}" method="post">
                            @method('PUT')
                             @csrf
                                <label for="nombreAldea">NombreAldea</libel>
                                <input type="text" name="nombreAldea" class="form-control" id ="nombreAldea">
                                <label for="tipo">Tipo de aldea</libel>
                                <select  name="tipo" class="form-control" id ="tipo">
                                    <option value="Capital OFF">Capital OFF</option>
                                    <option value="Capital DEFF">Capital DEFF</option> 
                                    <option value="Capital productora">Capital productora</option> 
                                    <option value="DEFF">DEFF</option> 
                                    <option value="OFF">OFF</option>
                                    <option value="Productora">Productora</option> 
                                </select>
                                <label for="coord_x">Coordenada X</libel>
                                <input type="text" name="coord_x" class="form-control" id ="coord_x"  type="number">
                                <label for="coord_y">Coordenada Y</libel>
                                <input type="text" name="coord_y" class="form-control" id ="coord_y"  type="number">
                                <label for="madera">Producción de madera</libel>
                                <input type="text" name="madera" class="form-control" id ="madera" min="1" pattern="^[0-9]+">
                                <label for="barro">Producción de barro</libel>
                                <input type="text" name="barro" class="form-control" id ="barro" min="1" pattern="^[0-9]+">
                                <label for="hierro">Producción de hierro</libel>
                                <input type="text" name="hierro" class="form-control" id ="hierro" min="1" pattern="^[0-9]+">
                                <label for="cereal">Producción de cereal</libel>
                                <input type="text" name="cereal" class="form-control" id ="cereal" min="1" pattern="^[0-9]+">
                                <label for="puntos_cultura">Puntos de cultura</libel>
                                <input  name="puntos_cultura" class="form-control" id ="puntos_cultura" min="1" pattern="^[0-9]+">

                                <label for="fiesta_grande">Fiesta grande</libel>
                                <select  name="fiesta_grande" class="form-control" id ="fiesta_grande">
                                    <option value="0">No</option> 
                                    <option value="1">Si</option>                  
                                </select>
                                <label for="fiesta_pequena">Fiesta pequeña</libel>
                                <select  name="fiesta_pequena" class="form-control" id ="fiesta_pequena">
                                    <option value="0">No</option> 
                                    <option value="1">Si</option> 
                                </select>
                                <div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
      </div>    
        <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
        <tr>
            <th>Nombre aldea</th>
            <th>Tipo aldea</th>
            <th>Prod madera</th>
            <th>Prod barro</th>
            <th>Prod hierro</th>
            <th>Prod cereal</th>
            <th>total Prod </th>
            <th>Prod pc</th>
            <th>Fiesta pequeña</th>
            <th>Fiesta grande</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
            @php
                $suma_madera_total = 0;
                $suma_barro_total = 0;
                $suma_hierro_total = 0;
                $suma_cereal_total = 0;
                $suma_materias_total = 0;
                $suma_puntosc_total = 0;
            @endphp
            @foreach($aldeas as $aldea)
            @php
                $suma_materias_aldea = $aldea->madera+$aldea->barro+$aldea->hierro+$aldea->cereal;
                $suma_madera_total =  $suma_madera_total + $aldea->madera;
                $suma_barro_total = $suma_barro_total+$aldea->barro;
                $suma_hierro_total =  $suma_hierro_total+ $aldea->hierro;
                $suma_cereal_total = $suma_cereal_total+$aldea->cereal;
                $suma_materias_total = $suma_materias_total + $suma_materias_aldea;
                $suma_puntosc_total =$suma_puntosc_total + $aldea->puntos_cultura;
                if($aldea->fiesta_pequena=='1'){
                    $fp = 'Si';
                }else{
                    $fp = 'No';
                }
                if($aldea->fiesta_grande==1){
                    $fg = 'Si';
                }else{
                    $fg = 'No';
                }
            @endphp
            <tr>
            <td>{{$aldea->nombre}}{{ __('  ') }}{{$aldea->coord_x }}{{ __('/') }}{{$aldea->coord_y }} </td>
            <td>{{$aldea->tipo}}</td>
            <td>{{$aldea->madera}}</td>
            <td>{{$aldea->barro}}</td>
            <td>{{$aldea->hierro}}</td>
            <td>{{$aldea->cereal}}</td>
            <td>{{$suma_materias_aldea}}</td>
            <td>{{$aldea->puntos_cultura}}</td>
            <td>{{$fp}}</td>
            <td>{{$fg}}</td>
            
            <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#editarAldea-{{$aldea->id}}" >
                Editar
                </button>  
                <button type="button" class="btn btn btn-danger float-right" data-toggle="modal" data-target="#eliminarAldeas-{{$aldea->id}}" >
                Eliminar
                </button>
            </div>
            </td>
            </tr>
            <div class="modal fade" id="eliminarAldeas-{{$aldea->id}}" tabindex="-1" role="dialog" aria-labelledby="eliminarAldeas-{{$aldea->id}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar aldea</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="/aldeas/borrar" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        ¿Está seguro que desea eliminar la aldea "{{ $aldea->nombre}}"?
                                    </div>
                                    <input  name="idAldea" type="hidden" value="{{$aldea->id}}">
                                    <div class="modal-footer">
                                        <button type="button"class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editarAldea-{{$aldea->id}}" tabindex="-1" role="dialog" aria-labelledby="editarAldea-{{$aldea->id}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Editar aldea</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="/aldeas/editar" action="{{'submit'}}" method="post">
                                    @method('PUT')
                                    @csrf
                                        <label for="nombreAldea">NombreAldea</libel>
                                        <input type="text" name="nombreAldea" class="form-control" id ="nombreAldea" value = "{{$aldea->nombre}}">
                                        <label for="tipo">Tipo de aldea</libel>
                                        <select  name="tipo" class="form-control" id ="tipo">
                                        @switch(true)
                                            @case($aldea->tipo == 'Capital OFF')
                                                <option value="Capital OFF" selected = 'selected'>Capital OFF</option>
                                                <option value="Capital DEFF">Capital DEFF</option> 
                                                <option value="Capital productora">Capital productora</option> 
                                                <option value="DEFF" >DEFF</option> 
                                                <option value="OFF">OFF</option>
                                                <option value="Productora">Productora</option> 
                                                @break
                                            @case($aldea->tipo == 'Capital Deff')
                                                <option value="Capital OFF">Capital OFF</option>
                                                <option value="Capital DEFF" selected = 'selected'>Capital DEFF</option> 
                                                <option value="Capital productora">Capital productora</option> 
                                                <option value="DEFF" >DEFF</option> 
                                                <option value="OFF">OFF</option>
                                                <option value="Productora" >Productora</option> 
                                                @break
                                            @case($aldea->tipo == 'Capital productora')
                                                <option value="Capital OFF">Capital OFF</option>
                                                <option value="Capital DEFF">Capital DEFF</option> 
                                                <option value="Capital productora" selected = 'selected'>Capital productora</option> 
                                                <option value="DEFF" >DEFF</option> 
                                                <option value="OFF">OFF</option>
                                                <option value="Productora" >Productora</option> 
                                                @break
                                             @case($aldea->tipo == 'DEFF')
                                                <option value="Capital OFF">Capital OFF</option>
                                                <option value="Capital DEFF">Capital DEFF</option> 
                                                <option value="Capital productora">Capital productora</option> 
                                                <option value="DEFF" selected = 'selected'>DEFF</option> 
                                                <option value="OFF">OFF</option>
                                                <option value="Productora" >Productora</option> 
                                                @break
                                            @case($aldea->tipo == 'OFF')
                                                <option value="Capital OFF">Capital OFF</option>
                                                <option value="Capital DEFF">Capital DEFF</option> 
                                                <option value="Capital productora">Capital productora</option> 
                                                <option value="DEFF" >DEFF</option> 
                                                <option value="OFF" selected = 'selected'>OFF</option>
                                                <option value="Productora" >Productora</option> 
                                                @break
                                            @case($aldea->tipo == 'Productora')
                                                <option value="Capital OFF">Capital OFF</option>
                                                <option value="Capital DEFF">Capital DEFF</option> 
                                                <option value="Capital productora">Capital productora</option> 
                                                <option value="DEFF" >DEFF</option> 
                                                <option value="OFF">OFF</option>
                                                <option value="Productora" selected = 'selected'>Productora</option> 
                                                @break
                                        @endswitch        
                                        </select>
                                         <label for="madera">Producción de madera</libel>
                                        <input type="text" name="madera" class="form-control" id ="madera" min="1" pattern="^[0-9]+" value = "{{$aldea->madera}}">
                                        <label for="barro">Producción de barro</libel>
                                        <input type="text" name="barro" class="form-control" id ="barro" min="1" pattern="^[0-9]+" value = "{{$aldea->barro}}">
                                        <label for="hierro">Producción de hierro</libel>
                                        <input type="text" name="hierro" class="form-control" id ="hierro" min="1" pattern="^[0-9]+" value = "{{$aldea->hierro}}">
                                        <label for="cereal">Producción de cereal</libel>
                                        <input type="text" name="cereal" class="form-control" id ="cereal" min="1" pattern="^[0-9]+" value = "{{$aldea->cereal}}">
                                        <label for="puntos_cultura">Puntos de cultura</libel>
                                        <input  name="puntos_cultura" class="form-control" id ="puntos_cultura" min="1" pattern="^[0-9]+" value = "{{$aldea->puntos_cultura}}">

                                        <label for="fiesta_grande">Fiesta grande</libel>
                                        <select  name="fiesta_grande" class="form-control" id ="fiesta_grande">
                                            @switch(true)
                                                @case($aldea->fiesta_grande == '0')
                                                    <option value="0" selected = 'selected'>No</option> 
                                                    <option value="1">Si</option> 
                                                    @break
                                                @case($aldea->fiesta_grande == '1')
                                                    <option value="0">No</option> 
                                                    <option value="1" selected = 'selected'>Si</option> 
                                                    @break
                                            @endswitch                     
                                        </select>
                                        <label for="fiesta_pequena">Fiesta pequeña</libel>
                                        <select  name="fiesta_pequena" class="form-control" id ="fiesta_pequena">
                                            @switch(true)
                                                @case($aldea->fiesta_pequena == '0')
                                                    <option value="0" selected = 'selected'>No</option> 
                                                    <option value="1">Si</option> 
                                                    @break
                                                @case($aldea->fiesta_pequena == '1')
                                                    <option value="0">No</option> 
                                                    <option value="1" selected = 'selected'>Si</option> 
                                                    @break
                                                @endswitch  
                                        </select>
                                        <input  name="idAldea" type="hidden" value="{{$aldea->id}}">
                                        <div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th></th>
            
            <th>Total:</th>
            <th>{{$suma_madera_total}}</th>
            <th>{{$suma_barro_total}}</th>
            <th>{{$suma_hierro_total}}</th>
            <th>{{$suma_cereal_total}}</th>
            <th>{{$suma_materias_total}}</th>
            <th>{{$suma_puntosc_total}}</th>
        
        </tr>
        </tfoot>
    </table>
  </div>

  
</div>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>
</x-app-layout>