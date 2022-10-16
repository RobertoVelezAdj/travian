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


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center ">
        <div class="card-body "> 
       
           
        <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>Nombre aldea</th>
                <th>Tipo aldea</th>
                <th>Cuartel</th>
                <th>Cuartel g.</th>
                <th>Establo</th>
                <th>Establo g.</th>
                <th>Taller</th>
                <th>Ayun.</th> 
                <th>P. torneos</th>  
                <th>O. comercio</th>   
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
           
            @foreach($aldeas as $aldea)

            <td>{{$aldea->nombre}}{{ __('  ') }}{{$aldea->coord_x }}{{ __('/') }}{{$aldea->coord_y }} </td>
            <td>{{$aldea->tipo}}</td>
            <td>{{$aldea->cuartel}}</td>
            <td>{{$aldea->cuartel_g}}</td>
            <td>{{$aldea->establo}}</td>
            <td>{{$aldea->establo_g}}</td>
            <td>{{$aldea->taller}}</td>
            <td>{{$aldea->ayuntamiento}}</td>
            <td>{{$aldea->p_torneos}}</td>
            <td>{{$aldea->o_comercio}}</td>
            <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#editarAldea-{{$aldea->id}}" >
                Editar
                </button>  
            </div>
            </td>
            </tr>
           
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
                                <form action="/aldeas/edificioseditar" action="{{'submit'}}" method="post">
                                    @method('PUT')
                                    @csrf
                                        <label for="nombreAldea">NombreAldea</libel>
                                        <input type="text" name="nombreAldea" class="form-control" id ="nombreAldea" value = "{{$aldea->nombre}}" readonly>
                                        <label for="madera">Cuartel</libel>
                                            <input type="text" name="cuartel" class="form-control" id ="cuartel" min="1" pattern="^[0-9]+" value = "{{$aldea->cuartel}}">
                                        <label for="madera">Cuartel grande</libel>
                                            <input type="text" name="cuartel_g" class="form-control" id ="cuartel_g" min="1" pattern="^[0-9]+" value = "{{$aldea->cuartel_g}}">
                                        <label for="madera">Establo</libel>
                                            <input type="text" name="establo" class="form-control" id ="establo" min="1" pattern="^[0-9]+" value = "{{$aldea->establo}}">
                                        <label for="madera">Establo grande</libel>
                                            <input type="text" name="establo_g" class="form-control" id ="establo_g" min="1" pattern="^[0-9]+" value = "{{$aldea->establo_g}}">
                                        <label for="taller">Taller</libel>
                                            <input type="text" name="taller" class="form-control" id ="taller" min="1" pattern="^[0-9]+" value = "{{$aldea->taller}}">
                                        <label for="taller">Ayuntamiento</libel>
                                            <input type="text" name="ayuntamiento" class="form-control" id ="ayuntamiento" min="1" pattern="^[0-9]+" value = "{{$aldea->ayuntamiento}}">
                                        <label for="taller">Plaza de torneos</libel>
                                            <input type="text" name="p_torneos" class="form-control" id ="p_torneos" min="1" pattern="^[0-9]+" value = "{{$aldea->p_torneos}}">
                                        <label for="taller">Oficina de comecio</libel>
                                            <input type="text" name="o_comercio" class="form-control" id ="o_comercio" min="1" pattern="^[0-9]+" value = "{{$aldea->o_comercio}}">
                                       
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