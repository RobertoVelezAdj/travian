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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tareas de las aldeas') }}
        </h2>
</x-slot>


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center ">
    <div class="card-body "> 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg> 
                Nueva tarea
            </button>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Nueva tarea</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form action="/aldeas/tareanueva" action="{{'submit'}}" method="post">
                            @method('PUT')
                             @csrf
                                
                                <label for="prioridad">Prioridad de tarea</libel>
                                <select  name="prioridad" class="form-control" id ="prioridad">
                                    <option value="1">1</option>
                                    <option value="2">2</option> 
                                    <option value="3">3</option> 
                                    <option value="4">4</option> 
                                    <option value="5">5</option>
                                </select>
                                <label for="aldea">Aldea asociada</libel>
                                <select  name="id_aldea" class="form-control" id ="id_aldea">
                                    @foreach($aldeas as $aldea)
                                        <option value="{{$aldea->id}}">{{$aldea->nombre}}({{$aldea->coord_x }}/{{$aldea->coord_y }})</option>
                                    @endforeach
                                </select>
                                <label for="Titulo">Titulo</libel>
                                <input type="text" name="titulo" class="form-control" id ="titulo"  >
                                <label for="Descripcion">Descripción</libel>
                                <input type="text" name="Descripcion" class="form-control" id ="Descripcion" >
                               
                                <div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                        </form>
                     </div>
                </div>
            </div>
         </div>
</div> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card-body">
                    <table  name = "ttareas" id="ttareas" class="table table-bordered table-striped  ">
                        <thead>
                            <tr>
                                <th>Prioridad</th>
                                <th>Aldea</th>
                                <th>Titulo</th>
                                <th>Descripción</th>     
                                <th>Opciones</th>            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tareas as $tarea)
                                <tr>
                                    <td>{{$tarea->prioridad}}</td>
                                    <td>{{$tarea->nombre}}</td>
                                    <td>{{$tarea->titulo}}</td>
                                    <td>{{$tarea->texto}}</td>
                                    <td><div class="btn-group btn-group-sm" role="group" aria-label="...">
                                            <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#editar-{{$tarea->id_tarea}}" >
                                            Cambiar prioridad
                                            </button>  
                                            <button type="button" class="btn btn btn-success float-right" data-toggle="modal" data-target="#completar-{{$tarea->id_tarea}}" >
                                            Completar
                                            </button>
                                        </div>
                                    </td>
                                    <div class="modal fade" id="completar-{{$tarea->id_tarea}}" tabindex="-1" role="dialog" aria-labelledby="completar-{{$tarea->id_tarea}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Completar tarea<h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <form action="/aldeas/completarTarea" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                ¿Está seguro que desea completar la tarea "{{$tarea->titulo}}"?
                                                            </div>
                                                            <input  name="id_tarea" type="hidden" value="{{$tarea->id_tarea}}">
                                                            <div class="modal-footer">
                                                                <button type="button"class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Completar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                 <div class="modal fade" id="editar-{{$tarea->id_tarea}}" tabindex="-1" role="dialog" aria-labelledby="editar-{{$tarea->id_tarea}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Cambiar prioridad</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <form action="/aldeas/editartarea" action="{{'submit'}}" method="post">
                                                        @method('PUT')
                                                        @csrf
                                                            <label for="nombreAldea">Nueva prioridad de "{{$tarea->titulo}}":</label>
                                                            <select  name="prioridad" class="form-control" id ="prioridad">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option> 
                                                                <option value="3">3</option> 
                                                                <option value="4">4</option> 
                                                                <option value="5">5</option>
                                                            </select>
                                                            <input  name="idTarea" type="hidden" value="{{$tarea->id_tarea}}">
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
        </div>
    </div>
<script>
    $(function () {
        $('#ttareas').DataTable({
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