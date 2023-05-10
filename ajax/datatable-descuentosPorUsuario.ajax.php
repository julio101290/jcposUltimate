<?php

require_once "../modelos/descuentos.modelo.php";
session_start();

if (!$_SESSION["iniciarSesion"]) {
    return;
}


if (isset($_POST["LEERTABLADESCUENTOSPORUSUARIO"])) {




    $idDescuento = $_POST["idDescuento"];
    $usuariosDescuento = ModeloDescuentos::mdlDescuentosPorUsuario($idDescuento);
    
    

 
    if (count($usuariosDescuento) == 0) {

        echo '{"data": []}';

        return;
    }

    $datosJson = '{
		  "data": [';

    for ($i = 0; $i < count($usuariosDescuento); $i++) {

        /* =============================================
          TRAEMOS LAS ACCIONES
          ============================================= */


        $botonPermiteVer = "";

        if ($usuariosDescuento[$i]["estado"] == "NO") {

            $botonPermiteVer = '<td><button type=\"button\" class=\"btn btn-danger btn-xs btnPermiteVer\" idUsuario=\"' . $usuariosDescuento[$i]["idUsuario"] .'\"  idDescuento=\"' . $idDescuento . '\" permiteVer=\"NO\">NO</button></td>';
        } else {

            $botonPermiteVer =  '<td><button type=\"button\" class=\"btn btn-success btn-xs btnPermiteVer\" idUsuario=\"' . $usuariosDescuento[$i]["idUsuario"] .'\"  idDescuento=\"' . $idDescuento . '\" permiteVer=\"SI\">SI</button></td>';
        }
        
    









        $datosJson .= '[
			      "' . $usuariosDescuento[$i]["usuario"] . '",
                              "' . $usuariosDescuento[$i]["descripcion"] . '",
			      "' .$botonPermiteVer . '"
		
			    ],';
    }

    $datosJson = substr($datosJson, 0, -1);

    $datosJson .= '] 

		 }';

    echo $datosJson;
}




if (isset($_POST["ACTIVARDESACTIVAR"])) {
    
    include_once '../modelos/descuentos.modelo.php';
    
    $campo = "estado";
    $valor = $_POST["valor"];
    $idUsuario = $_POST["idUsuario"];
    $idDescuento = $_POST["idDescuento"];
    
    
    
    $datos["estado"]= $valor;
    $datos["idUsuario"]= $idUsuario;
    $datos["idDescuento"]= $idDescuento;

    /**
     * Verificamos si existe registro
     */
    
        $registros= ModeloDescuentos::mdlMostrarUsuariosPorDescuento($idUsuario, $idDescuento);
        
        
        if(count($registros)>0){
            
            //ACTUALIZA
            $actualiza = ModeloDescuentos::mdlActualizarDescuentoUsuario($datos);
            
            echo $actualiza;
            
        }else{

            
  
            
            $inserta = ModeloDescuentos::mdlInsertarDescuentoUsuario($datos);
            
            echo $inserta;
            
        }
    
    
}