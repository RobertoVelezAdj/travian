<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información de las aldeas') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center ">
        <div class="card-body "> 
            <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#nuevaAldea" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg> 
                Nueva aldea
            </button>
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
                <button type="button" class="btn btn-warning float-right" data-bs-toggle="modal" data-bs-target="#editarAldea-{{$aldea->id}}" >
                Editar
                </button>  
                <button type="button" class="btn btn btn-danger float-right" data-bs-toggle="modal" data-bs-target="#eliminarAldeas-{{$aldea->id}}" >
                Eliminar
                </button>
            </div>
            </td>
            </tr>
            <div class="modal fade" id="editarAldea-{{$aldea->id}}" tableindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
            <div class="modal-dialog modal-lg modal-dialog-centered"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edición aldea</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/aldeas/{{$aldea->id}}/editar" method="POST">
                                {{ csrf_field()}}
                                <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombreAldea">NombresssAldea</label>
                                    <input type="text" name="nombreAldea" class="form-control" id ="nombreAldea" readonly="readonly" value="{{$aldea->nombre}}">
                                    <label for="coord_x">Coordenada X</label>
                                    <input type="text" name="coord_x" class="form-control" id ="coord_x" readonly="readonly"  value="{{$aldea->coord_x}}">
                                    <label for="coord_y">Coordenada Y</label>
                                    <input type="text" name="coord_y" class="form-control" id ="coord_y" readonly="readonly" value="{{$aldea->coord_y}}">

                                    <label for="madera">Producción de madera</label>
                                    <input type="text" name="madera" class="form-control" id ="madera" value="{{$aldea->madera}}">
                                    <label for="barro">Producción de barro</label>
                                    <input type="text" name="barro" class="form-control" id ="barro" value="{{$aldea->barro}}">
                                    <label for="hierro">Producción de hierro</label>
                                    <input type="text" name="hierro" class="form-control" id ="hierro" value="{{$aldea->hierro}}">
                                    <label for="cereal">Producción de cereal</label>
                                    <input type="text" name="cereal" class="form-control" id ="cereal" value="{{$aldea->cereal}}">
                                    <label for="puntos_cultura">Puntos de cultura</label>
                                    <input type="text" name="puntos_cultura" class="form-control" id ="puntos_cultura" value="{{$aldea->puntos_cultura}}"> 
                                    <label for="tipo">Tipo de aldea</label>
                                    <select  name="tipo" class="form-control" id ="tipo" selected="{{$aldea->tipo}}">
                                    <option value="Capital">Capital</option> 
                                    <option value="DEFF">DEFF</option> 
                                    <option value="OFF">OFF</option>
                                    <option value="Productora">Productora</option> 
                                    </select>
                                    <label for="fiesta_grande">Fiesta grande</label>
                                    <select  name="fiesta_grande" class="form-control" id ="fiesta_grande" selected="{{$aldea->fiesta_grande}}">
                                    <option value="0">No</option> 
                                    <option value="1">Si</option>                  
                                    </select>
                                    <label for="fiesta_pequena">Fiesta `pequeña</label>
                                    <select  name="fiesta_pequena" class="form-control" id ="fiesta_pequena" selected="{{$aldea->fiesta_pequena}}">
                                    <option value="0">No</option> 
                                    <option value="1">Si</option> 
                                    </select>
                                </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>

            <div class="modal fade" id="eliminarAldeas-{{$aldea->id}}" tableindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg modal-dialog-centered"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar aldea</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/aldeas/{{$aldea->id}}/borrar" method="POST">
                                {{ csrf_field()}}
                                <div class="modal-body">
                                ¿Está seguro que desea eliminar la aldea? 
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
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