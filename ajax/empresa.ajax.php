<?php
require_once "../controladores/empresa.controlador.php";
require_once "../modelos/empresa.modelo.php";
require_once "../modelos/empresas.modelo.php";


class AjaxEmpresa{

    /*=============================================
    EDITAR EMPRESA
    =============================================*/ 


    public function ajaxEditarEmpresa(){



        $item =  "id";
        $valor = $_POST["idEmpresa"];
        $orden = null;

        
        $empresa = new ModeloEmpresas2();
        
        $empresa->id = $valor;
        
        $respuesta = $empresa->mdlMostrarEmpresa();

        echo json_encode($respuesta);

  }



}




/*=============================================
EDITAR MEDIDA
=============================================*/ 

if(isset($_POST["idEmpresa"])){

  $editarEmpresa = new AjaxEmpresa();
  $editarEmpresa -> ajaxEditarEmpresa();

}

