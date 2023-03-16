
<!--=====================================
MODAL DERECHOS DE EMPRESAS POR USUARIO
======================================-->

<div id="modalDescuentoPorUsuario" class="modal fade descuentoUsuario"  role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Descuentos Por Usuario</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">
                        <!--=====================================
                        CONTROLES
                        ======================================-->

                        <table class="table table-bordered table-striped dt-responsive tablaDescuentoUsuarios" width="100%">

                            <thead>

                                <tr>

                                    <th style="width:10px">Usuario</th>
                                    <th>Descuento</th>
                                    <th>Permite Ver </th>
                               


                                </tr>

                            </thead>

                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>9000</td>
                                    <td>1000</td>
                                  
                                </tr>



                            </tbody>

                        </table>


                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



                </div>



            </form>

        </div>

    </div>

</div>

<script>


    /**
     * Evento Click btnDescuentoUsuarios
     */
    $(".tablas").on("click", ".btnUsuarioPorDescuento", function () {


        var idDescuento = $(this).attr("idDescuento");

        console.log("idDescuento", idDescuento);
        $('.tablaDescuentoUsuarios').DataTable().destroy();
        cargaDescuentosUsuarios(idDescuento);

    });


    /**
     * 
     * CLICK PERMITE VER
     * 
     */

    $(".tablaDescuentoUsuarios").on("click", ".btnPermiteVer", function () {

        var boton = $(this);
        var idUsuario = $(this).attr("idUsuario");
        var idDescuento = $(this).attr("idDescuento");
        var permiteVer = $(this).attr("permiteVer");


       console.log("asd");

        var campo = "permiteVer";
        var valor = "";

        if (permiteVer == "NO") {

            valor = "SI";

        } else {

            valor = "NO";

        }


        
        var datos = new FormData();
 	datos.append("idUsuario", idUsuario);
        datos.append("idDescuento", idDescuento);
        datos.append("valor", valor);
  	datos.append("ACTIVARDESACTIVAR", "ACTIVARDESACTIVAR");

        $.ajax({

        url:"ajax/datatable-descuentosPorUsuario.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){
                    
                    console.log(respuesta);
                    
                    if(respuesta=="ok"){
                        
                        if(valor=="SI"){
                            
                            boton.removeClass("btn-danger");
                            boton.addClass('btn-success');
                            boton.html('SI');
                            boton.attr('permiteVer',"SI");
                            
                        }else{
                            
                            boton.removeClass("btn-success");
                            boton.addClass('btn-danger');
                            boton.html('NO');
                            boton.attr('permiteVer',"NO");
                            
                        }
                        
                        
                    }
                    
                }


                })

    });




    /**
     * LISTA EMPRESAS USUARIOS
     */

    function cargaDescuentosUsuarios(idDescuento = '0', )
    {


        var dataTable = $('.tablaDescuentoUsuarios').DataTable({

            "processing": true,
            //"serverSide" : true,
            "deferRender": true,
            "retrieve": true,
            "pageLength": 25,
            "lengthMenu": [10, 25, 50, 100, 150, 200],

            "language": {

                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",

                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }

            },
            "ajax": {
                url: "ajax/datatable-descuentosPorUsuario.ajax.php",
                type: "POST",

                data: {
                    idDescuento: idDescuento
                    , LEERTABLADESCUENTOSPORUSUARIO: "LEERTABLADESCUENTOSPORUSUARIO"
                }


            }

        });



    }

</script>