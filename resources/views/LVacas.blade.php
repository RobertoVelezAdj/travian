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
            <div>{{ __('Lista de vacas') }}</div>
        </h2>
      
    </x-slot>
 
     <div class="py-12">
        <div class="w-75 p-3 mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card-body">
                    <table id="taldeas" class="table table-bordered table-striped table-responsive ">
                        <thead>
                                <tr>
                                    <th>Nombre aldea Lanza</th>
                                    <th>Nombre aldea vaca</th>
                                    <th>Nombre cuenta vaca</th>
                                    <th>Nombre alianza vaca</th>
                                    <th>Población</th>                        
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($info as $aldea)
                            <tr>
                                    <td>{{$aldea->nombreLanza}} <a target="_blank" href="{{$aldea->ruta}}/position_details.php?x={{$aldea->aldeaLanzax}}&y={{$aldea->aldeaLanzay}}" >{{$aldea->aldeaLanzax }}{{ __('/') }}{{$aldea->aldeaLanzay }}</a></td>
                                    <td>{{$aldea->nombrealdeaVaca}} <a target="_blank" href="{{$aldea->ruta}}/position_details.php?x={{$aldea->vacax}}&y={{$aldea->vacay}}" >{{$aldea->vacax }}{{ __('/') }}{{$aldea->vacay }}</a> </td>
                                    <td><a target="_blank" href="{{$aldea->ruta}}/profile/{{$aldea->idcuentavaca}}" >{{$aldea->cuentaVaca}} </a></td>
                                    <td><a target="_blank" href="{{$aldea->ruta}}/alliance/{{$aldea->alivaca}}" >{{$aldea->alianzaVaca}}</a> </td>
                                    <td>{{$aldea->poblacion}}</td>
                            </tr>   
                            @endforeach
                        </tbody>
                        </foot>
                        </foot>
                    </table>
                </div>
            </div>
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
