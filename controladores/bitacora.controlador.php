<?php

class ControladorBitacora {
    /* =============================================
      MOSTRAR BITACORA
      ============================================= */

    static public function ctrMostrarBitacora($request, $noLimit) {
        
        return ModeloBitacora::mdlMostrarBitacora("bitacora", $request, $noLimit);
    }

    /* =============================================
      CREAR BITACORA
      ============================================= */

    static public function ctrCrearBitacora($datos) {


        $tabla = "bitacora";

        $datos = array("descripcion" => $datos["descripcion"],
            "usuario" => $datos["usuario"]
        );

        $respuesta = ModeloBitacora::mdlIngresarBitacora($tabla, $datos);
    }
}
