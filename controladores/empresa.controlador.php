<?php

class ControladorEmpresa {
    /* =============================================
      MOSTRAR EMPRESA
      ============================================= */

    static public function ctrMostrarEmpresas($item, $valor) {

        $tabla = "datosempresa";
        $item = null;
        $valor = null;
        $respuesta = ModeloEmpresas::mdlMostrarEmpresa($tabla, $item, $valor);

        return $respuesta;
    }

    /* =============================================
      EDITAR EMPRESA
      ============================================= */

    static public function ctrEditarEmpresa() {

        if (isset($_POST["editarNombreEmpresa"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreEmpresa"])) {

                $tabla = "datosempresa";

                $datos = array("nombreEmpresa" => $_POST["editarNombreEmpresa"],
                    "DireccionEmpresa" => $_POST["editarDireccionEmpresa"],
                    "RFC" => $_POST["editarRFC"],
                    "telefonoEmpresa" => $_POST["editarTelefonoEmpresa"],
                    "diasEntrega" => $_POST["editarDiasEntrega"],
                    "caja" => $_POST["caja"],
                    "correoElectronicoEmpresa" => $_POST["editarCorreoElectronicoEmpresa"]
                );

                $respuesta = ModeloEmpresas::mdlEditarEmpresa($tabla, $datos);

                if ($respuesta == "ok") {

                    echo'<script>

					swal({
						  type: "success",
						  title: "La empresa ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "datosEmpresa";

									}
								})

					</script>';
                }
            } else {

                echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';
            }
        }
    }
}

if (isset($_POST["GUARDAREMPRESA"])) {
    error_reporting(0);
    include_once '../modelos/empresas.modelo.php';

    if ($_POST["id"] > 0) {


        $empresa = new ModeloEmpresas2();

        $empresa->CURP = $_POST["CURP"];
        $empresa->DireccionEmpresa = $_POST["DireccionEmpresa"];
        $empresa->NombreEmpresa = $_POST["NombreEmpresa"];
        $empresa->RFC = $_POST["RFC"];
        $empresa->Telefono = $_POST["Telefono"];
        $empresa->codigoPostal = $_POST["codigoPostal"];
        $empresa->contraCertificado = $_POST["contraCertificado"];
        $empresa->contraEmpresa = $_POST["contraEmpresa"];
        $empresa->correoElectronico = $_POST["correoElectronico"];
        $empresa->diasEntrega = $_POST["diasEntrega"];
        $empresa->id = $_POST["idEmpresa"];

        if (isset($_FILES["logo"]["tmp_name"]) && $_FILES["logo"]["tmp_name"] != "") {

            $empresa->logo = fopen($_FILES['logo']['tmp_name'], "rb");
        } else {

            $empresa->logo = null;
        }

        if (isset($_FILES["archivoKey"]["tmp_name"]) && $_FILES["archivoKey"]["tmp_name"] != "") {

            $empresa->archivoKey = fopen($_FILES['archivoKey']['tmp_name'], "rb");
        } else {

            $empresa->archivoKey = null;
        }

        if (isset($_FILES["certificado"]["tmp_name"]) && $_FILES["certificado"]["tmp_name"] != "") {

            $empresa->certificado = fopen($_FILES['certificado']['tmp_name'], "rb");
        } else {

            $empresa->certificado = null;
        }


        $empresa->razonSocial = $_POST["razonSocial"];
        $empresa->regimenFiscal = $_POST["regimenFiscal"];

        $actualizar = $empresa->mdlActualizar();

        echo $actualizar;
    } else {

        $empresa = new ModeloEmpresas2();

        $empresa->CURP = $_POST["CURP"];
        $empresa->DireccionEmpresa = $_POST["DireccionEmpresa"];
        $empresa->NombreEmpresa = $_POST["NombreEmpresa"];
        $empresa->RFC = $_POST["RFC"];
        $empresa->Telefono = $_POST["Telefono"];
        $empresa->codigoPostal = $_POST["codigoPostal"];
        $empresa->contraCertificado = $_POST["contraCertificado"];
        $empresa->contraEmpresa = $_POST["contraEmpresa"];
        $empresa->correoElectronico = $_POST["correoElectronico"];
        $empresa->diasEntrega = $_POST["diasEntrega"];
        $empresa->id = $_POST["id"];
        if (isset($_FILES["logo"]["tmp_name"]) && $_FILES["logo"]["tmp_name"] != "") {

            $empresa->logo = fopen($_FILES['logo']['tmp_name'], "rb");
        } else {

            $empresa->logo = null;
        }


        if (isset($_FILES["archivoKey"]["tmp_name"]) && $_FILES["archivoKey"]["tmp_name"] != "") {

            $empresa->archivoKey = fopen($_FILES['archivoKey']['tmp_name'], "rb");
        } else {

            $empresa->archivoKey = null;
        }

        if (isset($_FILES["certificado"]["tmp_name"]) && $_FILES["certificado"]["tmp_name"] != "") {

            $empresa->certificado = fopen($_FILES['certificado']['tmp_name'], "rb");
        } else {

            $empresa->certificado = null;
        }



        $empresa->razonSocial = $_POST["razonSocial"];
        $empresa->regimenFiscal = $_POST["regimenFiscal"];

        echo $empresa->mdlInsertar();
    }
}