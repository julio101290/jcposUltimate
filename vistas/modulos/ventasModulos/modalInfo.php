<!--=====================================
MODAL INFORMACIÓN DE PAGO
======================================-->

<div id="modalMasInfo" class="modal fade masInfo"  role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Información de la Venta</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">
                        <!--=====================================
                        CONTROLES
                        ======================================-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i>Dirección Cliente</i></span>

                                <input class="form-control direccionCliente" id="direccionCliente" name="direccionCliente" readonly>


                            </div>
                        </div>
                        <table class="table table-bordered table-striped dt-responsive tablaInfo" width="100%">

                            <thead>

                                <tr>


                                    <th>Descripción </th>
                                    <th>Cantidad </th>
                                    <th>Precio</th>
                                    <th>Total</th>


                                </tr>

                            </thead>

                            <tbody>

                                <tr>
                                    <td>1</td>
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

                    <!--<button type="button" class="btn btn-primary btnGuardarPagoAjax">Guardar Venta</button HIDDEN> -->

                </div>

                <?php
                ?>


            </form>

        </div>

    </div>

</div>

<script>

    $(".AdministrarVentas").on("click", ".btnMasInfo", function () {
        
//        
        var idVenta = $(this).attr("idVenta");
        var idCliente = $(this).attr("idCliente");
        console.log(idVenta);
        //DESTRUIMOS LA TABLA
        $('.tablaInfo').DataTable().destroy();
        cargaDatosVenta(idVenta);

        datosVenta(idCliente);

    })



    function cargaDatosVenta(idVenta = '0')
    {

        var dataTable = $('.tablaInfo').DataTable({

            "processing": true,
            //"serverSide" : true,
            "deferRender": true,
            "retrieve": true,
            "pageLength": 10,
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
                url: "ajax/datatable-ProductosVenta.ajax.php",
                type: "POST",
                data: {
                    idVenta: idVenta

                }


            }

        });
    }

    function datosVenta(idCliente) {


        $("#direccionCliente").val("");
        var datos = new FormData();
        datos.append("idCliente", idCliente);
        $.ajax({

        url: "ajax/clientes.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {

                $("#direccionCliente").val(respuesta["direccion"]);
                
                }
            })
                
                
        
 
    }

</script>
