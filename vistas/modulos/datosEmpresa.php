<?php
if ($_SESSION["datosEmpresa"] == "off") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}
?>
<div class="content-wrapper">
    <section class="content-header">

        <h1>

            Datos Empresa 

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Datos Empresa </li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            
            <button class="btn btn-primary btnLimpiar" data-toggle="modal" data-target="#modalEditarEmpresa">

          Agregar Empresa

        </button>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Nombre Empresa</th>
                            <th>Direccion</th>
                            <th>RFC</th>
                            <th>Telefono</th>
                            <th>Correo Electronico</th>
                            <th>Acciones</th>

                        </tr> 

                    </thead>

                    <tbody>

                        <?php
                        $item = null;
                        $valor = null;

                        $empresa = ControladorEmpresa::ctrMostrarEmpresas($item, $valor);

                        foreach ($empresa as $key => $value) {

                            echo ' <tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["NombreEmpresa"] . '</td>
                  <td>' . $value["DireccionEmpresa"] . '</td>
				  <td>' . $value["RFC"] . '</td>
				  <td>' . $value["Telefono"] . '</td>
				  <td>' . $value["correoElectronico"] . '</td>
         '


                            ;

                            echo '
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarEmpresa" idEmpresa="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarEmpresa"><i class="fa fa-pencil"></i></button>

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
MODAL EDITAR EMPRESA
======================================-->

<div id="modalEditarEmpresa" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar empresa</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">


                    <ul class="nav nav-tabs">

                        <li class="active"><a data-toggle="tab" href="#generales">Datos Generales</a></li>

                        <li><a data-toggle="tab" href="#datosFacturacion">Datos Facturación</a></li>

                        <li><a data-toggle="tab" href="#archivos">Archivos</a></li>


                    </ul>

                    <div class="box-body">


                        <div class="tab-content">


                            <div id="generales" class="tab-pane fade-in active">

                                <?php
                                include_once 'datosEmpresa/generales.php';
                                ?>

                            </div>


                            <div id="datosFacturacion" class="tab-pane fade">

                                <?php
                                include_once 'datosEmpresa/datosFacturacion.php';
                                ?>

                            </div>


                            <div id="archivos" class="tab-pane fade">

                                <?php
                                include_once 'datosEmpresa/archivos.php';
                                ?>

                            </div>



                        </div>

                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->

                        <div class="modal-footer pieModal">

                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                            <button type="button" class="btn btn-primary btnGuardar" >Guardar</button>

                        </div>
                        </form>
                        <?php
                      //  $editarEmpresa = new ControladorEmpresa();
                      //  $editarEmpresa->ctrEditarEmpresa();
                        ?> 



                    </div>

                </div>

        </div>

    </div>
</div>


<script>


    $(".pieModal").on("click", ".btnGuardar", function () {



        var idEmpresa = $("#idEmpresa").val();
        var CURP = $("#CURP").val();
        var DireccionEmpresa = $("#editarDireccionEmpresa").val();
        var NombreEmpresa = $("#editarNombreEmpresa").val();
        var RFC = $("#editarRFC").val();
        var Telefono = $("#editarTelefonoEmpresa").val();
        var archivoKey = $("#archivoKey").prop("files")[0];
        var certificado = $("#certificado").prop("files")[0];
        var codigoPostal = $("#codigoPostal").val();
        var contraCertificado = $("#contraCertificado").val();
        var contraEmpresa = "";
        var correoElectronico = $("#editarCorreoElectronicoEmpresa").val();
        var diasEntrega = $("#editarDiasEntrega").val();
        var idEmpresa = $("#idEmpresa").val();
        var logo = $("#logo").prop("files")[0];
        var razonSocial = $("#razonSocial").val();
        var regimenFiscal = $("#regimenFiscal").val();
        
        
        
        var datosDocumento = new FormData();

        datosDocumento.append("GUARDAREMPRESA", "GUARDAREMPRESA");
        datosDocumento.append("CURP", CURP);
        datosDocumento.append("RFC", RFC);
        datosDocumento.append("DireccionEmpresa", DireccionEmpresa);
        datosDocumento.append("NombreEmpresa", NombreEmpresa);
        datosDocumento.append("Telefono", Telefono);
        datosDocumento.append("archivoKey", archivoKey);
        datosDocumento.append("certificado", certificado);
        datosDocumento.append("codigoPostal", codigoPostal);
        datosDocumento.append("contraCertificado", contraCertificado);
        datosDocumento.append("correoElectronico", correoElectronico);
        datosDocumento.append("diasEntrega", diasEntrega);
        datosDocumento.append("idEmpresa", idEmpresa);
        datosDocumento.append("logo", logo);
        datosDocumento.append("razonSocial", razonSocial);
        datosDocumento.append("regimenFiscal", regimenFiscal);
        datosDocumento.append("id", idEmpresa);
        $.ajax({

            url: "controladores/empresa.controlador.php",
            method: "POST",
            data: datosDocumento,
            cache: false,
            contentType: false,
            processData: false,
            //dataType: "json",
            success: function (respuesta) {

                console.log(respuesta);
                if (respuesta == "ok") {
                   
                    swal({
                        type: "success",
                        title:  "GUARDADO CORRECTAMENTE ",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function (result) {
                        if (result.value) {

                            window.location = "datosEmpresa";
                        }


                    });
                    
                    return;
                }else{
                    
                     swal({
                        type: "error",
                        title:  respuesta,
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    })
                    
                }
            }

        })
    })
    
    
    /**
     * Limpiar
     */
    
    
    $(".btnLimpiar").on("click",function(){
        
        limpiarFormulario();
        
    })
    
    
    function limpiarFormulario(){
        
        $(".previsualizarLogo").attr("src","vistas/img/usuarios/default/anonymous.png");
        
        $(".form-control").val("");
        
    }

</script>