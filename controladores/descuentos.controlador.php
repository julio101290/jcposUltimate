<?php

class ControladorDescuentos {

 

 /*=============================================
 REGISTRO
 =============================================*/

 static public function ctrIngresar(){


  if(isset($_POST["nuevoDescripcion"])){


    $tabla = "descuentos";


 $datos["nuevoId"] =  $_POST[ "nuevoId"];
 $datos["Id"] =  $_POST[ "editarId"];
 $datos["nuevoDescripcion"] =  $_POST[ "nuevoDescripcion"];
 $datos["Descripcion"] =  $_POST[ "editarDescripcion"];
 $datos["nuevoPorcentaje"] =  $_POST[ "nuevoPorcentaje"];
 $datos["Porcentaje"] =  $_POST[ "editarPorcentaje"];


    $respuesta = ModeloDescuentos::mdlIngresar($tabla, $datos);
    
    

    if($respuesta == "ok"){

     echo '<script>

     swal({

      type: "success",
      title: "Guardado correctamente!",
      showConfirmButton: true,
      confirmButtonText: "Cerrar"

     }).then(function(result){

      if(result.value){
      
       window.location = "descuentos ";

      }

     });
    

     </script>';


    }else{

                                    echo '<script>

     swal({

      type: "error",
      title: "'.$respuesta.'",
      showConfirmButton: true,
      confirmButtonText: "Cerrar"

     }).then(function(result){

      if(result.value){
      
       window.location = "descuentos";

      }

     });
    

     </script>';

                                } 


   
   }


 


 }

 /*=============================================
 MOSTRAR 
 =============================================*/

 static public function ctrMostrar($item, $valor){

  $tabla = "descuentos"; 

  $respuesta = ModeloDescuentos::mdlMostrar($tabla, $item, $valor); 

  return $respuesta;
 }

 /*=============================================
 EDITAR 
 =============================================*/

 static public function ctrEditar(){

  if(isset($_POST["editarDescuentos"])){



    $tabla = "descuentos";



  $datos = $_POST;
          

    $respuesta = ModeloDescuentos::mdlEditar($tabla, $datos); 

    if($respuesta == "ok"){

     echo'<script>

     swal({
        type: "success",
        title: "Editado correctamente",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result) {
         if (result.value) {

         window.location = "descuentos ";

         }
        })

     </script>';

    }
   else{

    echo'<script>

     swal({
        type: "error",
        title: "'.$respuesta.'",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result) {
       if (result.value) {

       window.location = "descuentos";

       }
      })

      </script>';

   

  }

}

 }







 /*=============================================
 BORRAR 
 =============================================*/

 static public function ctrBorrar(){

  if(isset($_GET["borrarDescuentos"])){

   $tabla ="descuentos ";
   $datos = $_GET["idDescuentos"];


   $respuesta = ModeloDescuentos::mdlBorrar($tabla, $datos); 

   if($respuesta == "ok"){

    echo'<script>

    swal({
       type: "success",
       title: "Borrado correctamente",
       showConfirmButton: true,
       confirmButtonText: "Cerrar",
       closeOnConfirm: false
       }).then(function(result) {
        if (result.value) {

        window.location = "descuentos ";

        }
       })

    </script>';

   }  

  }

 }


}
 // BUSCA Descuentos
 if(isset($_POST["buscarDescuentos"])) {
   
  include '../modelos/descuentos.modelo.php';
  
  $valor = $_POST["idDescuentos"];
  
 $respuesta = ModeloDescuentos::mdlMostrar("descuentos","id",$valor);
        
 echo json_encode($respuesta);
 
}
