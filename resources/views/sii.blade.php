<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SII</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>

    <div class="container card col-lg-10 p-3 mt-5 bg-light">
        <div class="text-center">
            <h1>Escribe tu rut y consulta tus datos:</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <form id="form-sii">
                    @csrf
                    <div class="form-group">
                        <label for="rut">RUT: </label>
                        <input type="text" class="form-control @error('rut') is-invalid @enderror"
                            placeholder="Ej: 20.020.680-0" name="rut" id="rut">
                        @error('rut')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-success">Consultar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="alerta">

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 list-clientes">
                <table class="table table-bordered table-hover" id="tabla-clientes">
                    <thead>
                        <tr>
                            <th>RUT</th>
                            <th>RAZON SOCIAL</th>
                            <th>Rubro</th>
                            <th>Categoria</th>
                            <th>Codigo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-clientes">
                        {{--   @foreach($clientes as $cliente)
                        <tr id={{$cliente->rut}}>
                        <td>{{$cliente->rut}}</td>
                        <td>{{$cliente->razon_social}}</td>
                        <td>{{$cliente->actividades}}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-primary" id="btn-editar" data-id="{{$cliente->rut}}"
                                    data-toggle="modal" data-target="#modaleditar">Editar</button>
                                <button class="btn btn-danger" id="btn-eliminar"
                                    data-id="{{$cliente->rut}}">Eliminar</button>
                            </div>
                        </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-editar">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="razon">Razon Social</label>
                            <input type="text" placeholder="Ingrese una razon social.." id="razon-input"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="actividad">Rubro</label>
                            <input type="text" placeholder="Ingrese la actividad que desempeña..." id="actividad-input"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <input type="text" class="form-control" placeholder="Ingrese la categoria de su actividad"
                                id="categoria-input">
                        </div>
                        <div class="form-group">
                            <label for="codigo">Codigo</label>
                            <input type="text" class="form-control" placeholder="Ingrese el codigo de su actidad"
                                id="codigo-input">
                        </div>

                        <input type="hidden" name="hidden_id" id="hidden_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button id="btn-update" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>

<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function(){
     
    
     /* Convertir tabla a datatable */
     var tabla =  $('#tabla-clientes').DataTable( {
        "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
        ajax: "{{route('home')}}",
       
        columns: [
            {data: 'rut',name: 'rut'},
            {data: 'razon_social',name: 'razon_social'},
            {data: 'actividades',name:'actividades'},
            {data: 'categoria',name: 'categoria'},
            {data: 'codigo',name: 'codigo'},
            {data: 'action',name: 'action', ordenable:false ,searchable: false}
        ],
        responsive: "true",
        dom: 'Bflrtip', 
        buttons: [
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> Exportar a PDF',
                titleAttr: 'Exportar a Pdf',
                className: 'btn btn-danger ml-4',
                pageSize: 'LEGAL', 
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ],
                }
            }
        ]
    } );
     

    /* Consultar rut a la API y mandar a guardarlos */
    $('#form-sii').submit((e)=>{
        e.preventDefault();
        var rut = $('#rut').val();
      
        $.ajax({
            type: 'POST',
            data: {
                "rut": rut,
                "_token": "{{ csrf_token() }}",
            },
            url: "{{route('consultar')}}",
            success: (data)=>{
                console.log(data);
                if(data.error){
                    console.log("EL rut ingresado es invalido");
                    $('.alerta').html(`<div class="alert alert-danger" role="alert">
                      <strong>El RUT ingresado es invalido</strong>
                        </div>`);
                    setTimeout(()=>{
                        $('.alerta').html("");
                    },3000)

                }else{
                    console.log("Datos enviados correctamente");
                    guardar(data);
                }
            },
          
        });
     });
     

     /*Almacenar datos en la BD*/
     function guardar(cliente){
        $.ajax({
            type:'POST',
            data: {
                rut: cliente.rut,
                razon_social: cliente.razon_social,
                actividades: cliente.actividades,
                "_token": "{{ csrf_token() }}"
            },
            url: "{{route('guardar')}}",
            success: (data) => {
               
                if(data.status!=200){
                    $('.alerta').html(`<div class="alert alert-danger" role="alert">
                      <strong>${data.mensaje}</strong>
                        </div>`);
                    setTimeout(()=>{
                        $('.alerta').html("");
                    },3000)
                }else{
                    $('.alerta').html(`<div class="alert alert-success" role="alert">
                          <strong>${data.mensaje}</strong></strong>
                    </div>`);
                    setTimeout(()=>{
                        $('.alerta').html("");
                    },3000)
                    tabla.ajax.reload();
                   /*  if(data.cliente.actividades){
                        $('#tbody-clientes').append(
                        `<tr>
                            <td>${data.cliente.rut}</td>
                            <td>${data.cliente.razon_social}</td>
                            <td>${data.cliente.actividades}</td>
                            <td>
                                <div class="btn-group">
                                <button class="btn btn-primary" id="btn-editar" data-id="${data.cliente.rut}" data-toggle="modal" data-target="#modaleditar">Editar</button>
                                <button class="btn btn-danger" id="btn-eliminar" data-id="${data.cliente.rut}"  >Eliminar</button>
                                </div>
                            </td>
                        </tr>`
                        );
                    }else{
                        $('#tbody-clientes').append(
                        `<tr>
                            <td>${data.cliente.rut}</td>
                            <td>${data.cliente.razon_social}</td>
                            <td>Sin actividad</td>
                            <td>
                                <div class="btn-group">
                                <button class="btn btn-primary" id="btn-editar" data-id="${data.cliente.rut}" data-toggle="modal" data-target="#modaleditar">Editar</button>
                                <button class="btn btn-danger" id="btn-eliminar" data-id="${data.cliente.rut}"  >Eliminar</button>
                                </div>
                            </td>
                        </tr>`
                    );
                    }  */
                }
            },
        });
     }
     
     /* Cargar datos y mostrar en ventana modal*/
    $('body').on('click', '#btn-editar', function () {
         var rut = $(this).attr('data-id');
         console.log(rut);
         $.ajax({
             type: "GET",
             url: window.location+"editar/"+rut,
             success: (data)=>{ 
                 console.log(data);
                $('#razon-input').val(data.razon_social);
                $('#actividad-input').val(data.actividades);
                $('#categoria-input').val(data.categoria);
                $('#codigo-input').val(data.codigo);
                $('#hidden_id').val(rut);
             }
         });
   });

   /* Recoger datos y actualizar en la BD */
   $('body').on('click','#btn-update',(e) => {
       e.preventDefault();
       var razon_social =  $('#razon-input').val();
       var actividad =  $('#actividad-input').val();
       var categoria =  $('#categoria-input').val();
       var codigo =   $('#codigo-input').val();
       var rut = $('#hidden_id').val();
        $.ajax({
            type: "POST",
            data: {
                razon_social: razon_social,
                actividad: actividad,
                codigo: codigo,
                categoria:categoria,
                "_token": "{{ csrf_token() }}",
            },
            url: window.location+"update/"+rut,
            success: (data) => {
                $('#modaleditar').modal("hide");
                console.log(data);
                $('.alerta').html(`<div class="alert alert-success" role="alert">
                          <strong>Cliente Actualizado exitosamente!</strong>
                    </div>`);
                    setTimeout(()=>{
                        $('.alerta').html("");
                },3000);
                tabla.ajax.reload();
            }
        })
   });

   /* Eliminar un registro*/
    $('body').on('click','#btn-eliminar',function(){
        var rut = $(this).attr("data-id");
        console.log(rut);  
        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            url: window.location+'delete/'+rut,
            success: (data) => {
                console.log(data);
                //location.reload();
                $('.alerta').html(`<div class="alert alert-success" role="alert">
                          <strong>Cliente Eliminado exitosamente!</strong>
                    </div>`);
                    setTimeout(()=>{
                        $('.alerta').html("");
                     },3000);
                //$('#tabla-clientes #tbody-clientes #'+data.rut).remove();
                tabla.ajax.reload();
            }

        }) 
    });

    });



</script>