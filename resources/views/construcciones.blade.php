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
<script>
  $(function () {
        $('#tconstrucciones').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });

   
  });
</script>
<script type="text/javascript">
    function calcularTotales(){
        let numeroFilas =  $("#topciones tr").length;
        console.log(numeroFilas);
        document.getElementById("topciones").rows[numeroFilas-1].cells[2].innerHTML = totalMadera;
        document.getElementById("topciones").rows[numeroFilas-1].cells[3].innerHTML = totalBarro;
        document.getElementById("topciones").rows[numeroFilas-1].cells[4].innerHTML = totalHierro;
        document.getElementById("topciones").rows[numeroFilas-1].cells[5].innerHTML = totalCereal;
        document.getElementById("topciones").rows[numeroFilas-1].cells[6].innerHTML = totalMadera+totalBarro+totalHierro+totalCereal;
        document.getElementById("topciones").rows[numeroFilas-1].cells[7].innerHTML = totalConsumo;
        document.getElementById("topciones").rows[numeroFilas-1].cells[8].innerHTML = totalpc;
    }
    
</script>
<script>
    let totalMadera = 0;
    let totalBarro = 0;
    let totalHierro = 0;
    let totalCereal = 0;
    let totalConsumo = 0;
    let totalpc = 0;
    let totalprodu = 0;
        function insertarFila(nom,lvl,m,b,h,c,con,p,prod){
            
            let topcionesDatos = document.getElementById("topciones").insertRow(1);
            let nombre = topcionesDatos.insertCell(0);
            let nivel = topcionesDatos.insertCell(1);
            let madera = topcionesDatos.insertCell(2);
            let barro = topcionesDatos.insertCell(3);
            let hierro = topcionesDatos.insertCell(4);
            let cereal = topcionesDatos.insertCell(5);
            let total = topcionesDatos.insertCell(6);
            let consumo = topcionesDatos.insertCell(7);
            let pc = topcionesDatos.insertCell(8);
            //let produccion = topcionesDatos.insertCell(9);
            
            nombre.innerHTML = nom;
            nivel.innerHTML = lvl;
            madera.innerHTML = m;totalMadera = totalMadera+m;
            barro.innerHTML = b; totalBarro = totalBarro+b;
            hierro.innerHTML = h;totalHierro = totalHierro+ h;
            cereal.innerHTML = c;totalCereal = totalCereal +c;
            total.innerHTML = m +b+h+c;
            consumo.innerHTML = con; totalConsumo = totalConsumo+con;
            pc.innerHTML = p; totalpc = totalpc +p;
            //produccion.innerHTML = prod; totalprodu = totalprodu+prod;
            calcularTotales(); 
        }
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Construcciones') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center ">
        <h1>Elegidos</h1>

    <a href="/construcciones" class="btn btn-primary btn-lg btn-block"> Refrescar</a>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card-body">
                    <table id="topciones" class="table table-bordered table-striped table-responsive ">
                        <thead>
                        <tr>
                            <th>Nombre edificio</th>
                            <th>Nivel</th>
                            <th>Madera</th>
                            <th>Barro</th>
                            <th>Hierro</th>
                            <th>Cereal</th>
                            <th>Total Materias</th>
                            <th>Consumo</th>
                            <th>PC</th>
                        </tr>
                        </thead>
                        <tbody>
                            <th></th>
                            <th>Total:</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center ">
        <h1 class="center">Construcciones</h1>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card-body">
                    <table id="tconstrucciones" class="table table-bordered table-striped table-responsive ">
                        <thead>
                        <tr>
                            <th>Nombre edificio</th>.
                            <th>Nivel</th>
                            <th>Madera</th>
                            <th>Barro</th>
                            <th>Hierro</th>
                            <th>Cereal</th>
                            <th>Total Materias</th>
                            <th>Consumo</th>
                            <th>PC</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($construcciones as $registro)
                        @php
                            $nombre = $registro->nombre_ed;
                            $nivel = $registro->nivel;
                            $ma = $registro->madera;
                            $ba = $registro->barro;
                            $hi = $registro->hierro;
                            $cere = $registro->cereal;
                            $consu = $registro->consumo;
                            $p = $registro->pc;
                            $prod = $registro->produccion;
                            $totalMAterias = $ma+$ba+$hi+$cere;
                            
                         @endphp
                        <tr>
                        <td>{{$registro->nombre_ed}}</td>
                        <td>{{$registro->nivel}}</td>
                        <td>{{$registro->madera}}</td>
                        <td>{{$registro->barro}}</td>
                        <td>{{$registro->hierro}}</td>
                        <td>{{$registro->cereal}}</td>
                        <td>{{$totalMAterias}}</td>
                        <td>{{$registro->consumo}}</td>
                        <td>{{$registro->pc}}</td>
                        <td>
                            <Button type ="button" onclick="insertarFila('{{$nombre}}',{{$nivel}},{{$ma}},{{$ba}},{{$hi}},{{$cere}},{{$consu}},{{$p}},{{$prod}})" class="btn btn-success">Insertar fila</Button></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
