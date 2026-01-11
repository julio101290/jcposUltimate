<?php
if ("off" == "offf") {

    echo '<script>

    window.location = "inicio"; 
 
  </script>';

    return;
}
?> 
<div class="content-wrapper">

    <section class="content-header">

        <h1> 

            Administrar <?php echo mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', ' Respaldos ')); ?> 

        </h1> 

        <ol class="breadcrumb"> 

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li> 

            <li class="active">Administrar <?php echo mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', 'Respaldos ')); ?></li> 

        </ol> 

    </section> 

    <section class="content"> 

        <div class="box"> 

            <div class="box-header with-border"> 

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRespaldos"> 

                    Agregar <?php echo mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', 'Respaldos ')); ?> 

                </button> 

            </div> 

            <div class="box-body"> 

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%"> 

                    <thead> 

                        <tr> 
                            <th>Id</th>
                            <th>Descripcion</th>
                            <th>Archivo</th>
                            <th>Uuid</th>
                            <th>Acciones</th>         </tr>  

                    </thead> 

                    <tbody> 

                        <?php
                        $item = null;
                        $valor = null;

                        $respaldos = ControladorRespaldos::ctrMostrar($item, $valor);

                        foreach ($respaldos as $key => $value) {

                            echo ' <tr> 
                                <td>' . $value["id"] . '</td>
                                <td>' . $value["descripcion"] . '</td>
                                <td>' . $value["archivo"] . '</td>
                                <td>' . $value["uuid"] . '</td>
                                <td> 
                                <div class = "btn-group"> 
                                                    <button class= "btn btn-warning btnDescargarRespaldos" UUIDRespaldo = "' . $value["uuid"] . '" > <i class = "fa  fa-cloud-download"> </i> </button> 
                                <button class = "btn btn-danger btnEliminarRespaldos" idRespaldos= "' . $value["id"] . '"><i class= "fa fa-times"></i></button>
                                </div>
                                </td> 

 
                </tr>';
                        }
                        ?>  

                    </tbody> 

                </table> 

            </div> 

        </div> 

    </section> 

</div> 

<!--===================================== 
MODAL <?php echo mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', ' respaldos ')); ?> 
 ======================================--> 


<div id="modalAgregarRespaldos" class="modal fade" role="dialog"> 

    <div class="modal-dialog"> 

        <div class="modal-content"> 

            <form role="form" method="post" enctype="multipart/form-data"> 

                <!--===================================== 
                CABEZA DEL MODAL 
                ======================================--> 

                <div class="modal-header" style="background:#3c8dbc; color:white"> 

                    <button type="button" class="close" data-dismiss="modal">&times;</button> 

                    <h4 class="modal-title">Agregar <?php echo mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', ' respaldos ')); ?> </h4> 

                </div> 
                <!--===================================== 
                CUERPO DEL MODAL 
                ======================================--> 

                <div class="modal-body"> 

                    <div class="box-body"> 

                        <!-- ENTRADA PARA DESCRIPCION --> 

                        <div class="form-group"> 

                            <div class="input-group"> 

                                <span class="input-group-addon">Descripcion: </span>  

                                <input type="text" class="form-control input-lg" name="nuevoDescripcion" placeholder="Ingresar Descripcion" required> 

                            </div> 

                        </div> 
                        <!-- ENTRADA PARA ARCHIVO --> 

                        <div class="form-group"> 

                            <div class="input-group"> 

                                <span class="input-group-addon">Archivo: </span>  

                                <input type="text" class="form-control input-lg" name="nuevoArchivo" placeholder="Ingresar Archivo" required> 

                            </div> 

                        </div> 
                        <!-- ENTRADA PARA UUID --> 

                        <div class="form-group"> 

                            <div class="input-group"> 

                                <span class="input-group-addon">Uuid: </span>  

                                <input type="text" class="form-control input-lg" name="nuevoUuid" placeholder="Ingresar Uuid" required> 

                            </div> 

                        </div> 






                    </div> 

                </div> 

                <!--===================================== 
                PIE DEL MODAL 
                ====================================== --> 

                <div class="modal-footer"> 

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button> 

                    <button type="submit" class="btn btn-primary">Guardar</button> 

                </div> 

                <?php
                $crear = new ControladorRespaldos();
                $crear->ctrIngresar();
                ?> 

            </form> 

        </div> 

    </div> 

</div> 

<!--===================================== 
MODAL EDITAR USUARIO 
 ======================================--> 


<div id="modalEditarRespaldos" class="modal fade" role="dialog">

    <div class="modal-dialog"> 

        <div class="modal-content"> 

            <form role="form" method="post" enctype="multipart/form-data"> 

                <!--===================================== 
                CABEZA DEL MODAL 
                ======================================--> 

                <div class="modal-header" style="background:#3c8dbc; color:white"> 

                    <button type="button" class="close" data-dismiss="modal">&times;</button> 

                    <h4 class="modal-title">Agregar <?php echo mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', ' respaldos ')); ?> </h4> 

                </div> 

                <!--===================================== 
                CUERPO DEL MODAL 
                ======================================--> 

                <div class="modal-body"> 

                    <div class="box-body"> 

                        <!-- ENTRADA PARA DESCRIPCION --> 

                        <!-- ENTRADA PARA ID --> 

                        <div class="form-group"> 

                            <div class="input-group"> 

                                <span class="input-group-addon">Id: </span>  

                                <input readonly  type="text" class="form-control input-lg" id="editarId" name="editarId" placeholder="Ingresar Id" required> 

                            </div> 

                        </div> 
                        <!-- ENTRADA PARA DESCRIPCION --> 

                        <div class="form-group"> 

                            <div class="input-group"> 

                                <span class="input-group-addon">Descripcion: </span>  

                                <input   type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" placeholder="Ingresar Descripcion" required> 

                            </div> 

                        </div> 
                        <!-- ENTRADA PARA ARCHIVO --> 

                        <div class="form-group"> 

                            <div class="input-group"> 

                                <span class="input-group-addon">Archivo: </span>  

                                <input   type="text" class="form-control input-lg" id="editarArchivo" name="editarArchivo" placeholder="Ingresar Archivo" required> 

                            </div> 

                        </div> 
                        <!-- ENTRADA PARA UUID --> 

                        <div class="form-group"> 

                            <div class="input-group"> 

                                <span class="input-group-addon">Uuid: </span>  

                                <input   type="text" class="form-control input-lg" id="editarUuid" name="editarUuid" placeholder="Ingresar Uuid" required> 

                            </div> 

                        </div> 
                        <input type="hidden" id="editarRespaldos"  name = "editarRespaldos" > 




                    </div> 

                </div> 

                <!--===================================== 
                PIE DEL MODAL 
                ======================================--> 

                <div class="modal-footer"> 

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button> 

                    <button type="submit" class="btn btn-primary">Modificar</button> 

                </div> 

                <?php
                $editar = new ControladorRespaldos();
                $editar->ctrEditar();
                ?>  

            </form> 

        </div> 

    </div> 

</div> 

<?php
$borrar = new ControladorRespaldos();
$borrar->ctrBorrar();
?>  
<script type="text/javascript">
    /*= == == == == == == == == == == == == == == == == == == == == == ==
     ELIMINAR RESPALDOS
     == == == == == == == == == == == == == == == == == == == == == == = */
    $(".tablas").on("click", ".btnEliminarRespaldos", function () {
        var idRespaldos = $(this).attr("idrespaldos");
        swal({
            title: '¿Está seguro de borrar?',
            text: "¡Si no lo está puede cancelar la accíón!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar!'
        }).then(function (result) {

            if (result.value) {

                window.location = "index.php?ruta=respaldos&idRespaldos=" + idRespaldos + "&borrarRespaldos=borrar";

            }

        })
    })




    /*= == == == == == == == == == == == == == == == == == == == == == ==
     DESCARGAR RESPALDO
     == == == == == == == == == == == == == == == == == == == == == == = */
    $(".tablas").on("click", ".btnDescargarRespaldos", function () {


        var UUIDRespaldo = $(this).attr("UUIDRespaldo");



        window.location = "controladores/respaldos.controlador.php?UUDIRespaldo=" + UUIDRespaldo;

    })
    /* = == == == == == == == == == == == == == == == == == == == == == ==
     EDITAR 
     == == == == == == == == == == == == == == == == == == == == == == = */
    $(".tablas").on("click", ".btnEditarRespaldos", function () {

        var idRespaldos = $(this).attr("idRespaldos");
        console.log(idRespaldos);

        var datos = new FormData();
        datos.append("idRespaldos", idRespaldos);
        datos.append("buscarRespaldos", "buscarRespaldos");


        $.ajax({

            url: "controladores/respaldos.controlador.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {

                $("#editarId").val(respuesta["id"]);
                $("#editarDescripcion").val(respuesta["descripcion"]);
                $("#editarArchivo").val(respuesta["archivo"]);
                $("#editarUuid").val(respuesta["uuid"]);


            }

        });

    })
</script>
