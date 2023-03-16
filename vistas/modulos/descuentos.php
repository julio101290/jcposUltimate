<?php

if("off" == "offf"){

  echo '<script>

    window.location = "inicio"; 
 
  </script>'; 
 
  return; 
 
} 



 
?> 
<div class="content-wrapper">
 
  <section class="content-header">
 
    <h1> 
 
      Administrar <?php echo  mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', ' Descuentos ')); ?> 
 
    </h1> 
 
    <ol class="breadcrumb"> 
 
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li> 
 
      <li class="active">Administrar <?php echo  mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', 'Descuentos ')); ?></li> 
 
    </ol> 
 
  </section> 
 
  <section class="content"> 
 
    <div class="box"> 
 
      <div class="box-header with-border"> 
 
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDescuentos"> 
 
          Agregar <?php echo  mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', 'Descuentos ')); ?> 
 
        </button> 
 
      </div> 
 
      <div class="box-body"> 
 
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%"> 
 
        <thead> 
 
         <tr> 
 <th>Id</th>
<th>Descripcion</th>
<th>Porcentaje</th>
<th>Acciones</th>         </tr>  
 
        </thead> 
 
        <tbody> 
 
        <?php 
 
        $item = null; 
        $valor = null; 
 
        $descuentos= ControladorDescuentos::ctrMostrar($item, $valor); 
 
       foreach ($descuentos as $key => $value){ 
 
          echo ' <tr> 
<td>'.$value["id"].'</td>
<td>'.$value["descripcion"].'</td>
<td>'.$value["porcentaje"].'</td>
<td> 
<div class = "btn-group"> 
  <button class="btn bg-purple btnUsuarioPorDescuento" idDescuento="'.$value["id"].'" data-toggle="modal" data-target="#modalDescuentoPorUsuario"><i class="fa fa-building"></i></button>
                    <button class= "btn btn-warning btnEditarDescuentos" idDescuentos = "'.$value["id"].'" data-toggle = "modal" data-target = "#modalEditarDescuentos"> <i class = "fa fa-pencil"> </i> </button> 
<button class = "btn btn-danger btnEliminarDescuentos" idDescuentos= "'.$value["id"].'"><i class= "fa fa-times"></i></button>
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
MODAL <?php echo  mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', ' descuentos ')); ?> 
 ======================================--> 
 
 
<div id="modalAgregarDescuentos" class="modal fade" role="dialog"> 
 
  <div class="modal-dialog"> 
 
    <div class="modal-content"> 
 
      <form role="form" method="post" enctype="multipart/form-data"> 
 
        <!--===================================== 
        CABEZA DEL MODAL 
        ======================================--> 
 
        <div class="modal-header" style="background:#3c8dbc; color:white"> 
 
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
 
          <h4 class="modal-title">Agregar <?php echo  mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', ' descuentos ')); ?> </h4> 
 
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
            <!-- ENTRADA PARA PORCENTAJE --> 
 
            <div class="form-group"> 
 
              <div class="input-group"> 
 
                <span class="input-group-addon">Porcentaje: </span>  
 
                <input type="text" class="form-control input-lg" name="nuevoPorcentaje" placeholder="Ingresar Porcentaje" required> 
 
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
 
           $crear = new ControladorDescuentos(); 
           $crear ->ctrIngresar(); 
 
        ?> 
 
      </form> 
 
    </div> 
 
  </div> 
 
</div> 
 
<!--===================================== 
MODAL EDITAR USUARIO 
 ======================================--> 
 
 
<div id="modalEditarDescuentos" class="modal fade" role="dialog">
 
  <div class="modal-dialog"> 
 
    <div class="modal-content"> 
 
      <form role="form" method="post" enctype="multipart/form-data"> 
 
        <!--===================================== 
        CABEZA DEL MODAL 
        ======================================--> 
 
        <div class="modal-header" style="background:#3c8dbc; color:white"> 
 
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
 
          <h4 class="modal-title">Agregar <?php echo  mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', ' descuentos ')); ?> </h4> 
 
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
            <!-- ENTRADA PARA PORCENTAJE --> 
 
            <div class="form-group"> 
 
              <div class="input-group"> 
 
                <span class="input-group-addon">Porcentaje: </span>  
 
                <input   type="text" class="form-control input-lg" id="editarPorcentaje" name="editarPorcentaje" placeholder="Ingresar Porcentaje" required> 
 
              </div> 
 
            </div> 
 <input type="hidden" id="editarDescuentos"  name = "editarDescuentos" > 
 
 
 
 
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
 
           $editar = new ControladorDescuentos(); 
           $editar ->ctrEditar(); 
 
        ?>  
 
      </form> 
 
    </div> 
 
  </div> 
 
</div> 
 
<?php 

   include_once 'descuentosModulos/descuentosPorUsuario.php';
   
   $borrar = new ControladorDescuentos(); 
   $borrar ->ctrBorrar(); 
 
?>  
<script type="text/javascript">
/*= == == == == == == == == == == == == == == == == == == == == == ==
 ELIMINAR DESCUENTOS
 == == == == == == == == == == == == == == == == == == == == == == = */
$(".tablas").on("click", ".btnEliminarDescuentos", function() {
    var idDescuentos = $(this).attr("iddescuentos");
    swal( {
        title: '¿Está seguro de borrar?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
       confirmButtonText: 'Si, borrar!'
    }).then(function(result) {

        if (result.value) {

            window.location = "index.php?ruta=descuentos&idDescuentos="+idDescuentos+"&borrarDescuentos=borrar";

        }

    })
})
/* = == == == == == == == == == == == == == == == == == == == == == ==
 EDITAR 
 == == == == == == == == == == == == == == == == == == == == == == = */
$(".tablas").on("click", ".btnEditarDescuentos", function() {

    var idDescuentos = $(this).attr("idDescuentos");
  console.log(idDescuentos);

    var datos = new FormData();
    datos.append("idDescuentos", idDescuentos); 
    datos.append("buscarDescuentos", "buscarDescuentos");
   

    $.ajax( {

        url:"controladores/descuentos.controlador.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
       dataType:"json",
       success: function(respuesta) {

            $("#editarId").val(respuesta["id"]); 
            $("#editarDescripcion").val(respuesta["descripcion"]); 
            $("#editarPorcentaje").val(respuesta["porcentaje"]); 

            
        }

    });

})
</script>
