<?php

session_start();
use DatabaseBackupManager\MySQLBackup;

class ControladorRespaldos {
    /* =============================================
      REGISTRO
      ============================================= */

    static public function ctrIngresar() {


        if (isset($_POST["nuevoDescripcion"])) {

            $host = BD_HOST;
            $port = BD_PUERTO;
            $dbname = BD_NOMBRE;
            $password = BD_CONTRA;
            $username = BD_USUARIO;

            $pdoDsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
            $dbBackupConnection = new \PDO($pdoDsn, $username, $password);
            
            
            
            $rutaArchivo= ROOTPATH . "/backups/";

            $backup = new MySQLBackup($dbBackupConnection,$rutaArchivo);
            
            $backup = $backup->backup(false, true, false);

            $tabla = "respaldos";

            $datos["nuevoId"] = $_POST["nuevoId"];
            $datos["Id"] = $_POST["editarId"];
            $datos["nuevoDescripcion"] = $_POST["nuevoDescripcion"];
            $datos["Descripcion"] = $_POST["editarDescripcion"];
            $datos["nuevoArchivo"] = $backup;;
            $datos["Archivo"] = $backup;
            $datos["nuevoUuid"] = ModeloGenerales::mdlGeneraUUID();
            $datos["Uuid"] = ModeloGenerales::mdlGeneraUUID();

            $respuesta = ModeloRespaldos::mdlIngresar($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

     swal({

      type: "success",
      title: "Guardado correctamente!",
      showConfirmButton: true,
      confirmButtonText: "Cerrar"

     }).then(function(result){

      if(result.value){
      
       window.location = "respaldos ";

      }

     });
    

     </script>';
            } else {

                echo '<script>

     swal({

      type: "error",
      title: "' . $respuesta . '",
      showConfirmButton: true,
      confirmButtonText: "Cerrar"

     }).then(function(result){

      if(result.value){
      
       window.location = "respaldos";

      }

     });
    

     </script>';
            }
        }
    }

    /* =============================================
      MOSTRAR
      ============================================= */

    static public function ctrMostrar($item, $valor) {

        $tabla = "respaldos ";

        $respuesta = ModeloRespaldos::mdlMostrar($tabla, $item, $valor);

        return $respuesta;
    }

    /* =============================================
      EDITAR
      ============================================= */

    static public function ctrEditar() {

        if (isset($_POST["editarRespaldos"])) {



            $tabla = "respaldos";

            $datos = $_POST;

            $respuesta = ModeloRespaldos::mdlEditar($tabla, $datos);

            if ($respuesta == "ok") {

                echo'<script>

     swal({
        type: "success",
        title: "Editado correctamente",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result) {
         if (result.value) {

         window.location = "respaldos ";

         }
        })

     </script>';
            } else {

                echo'<script>

     swal({
        type: "error",
        title: "' . $respuesta . '",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result) {
       if (result.value) {

       window.location = "respaldos";

       }
      })

      </script>';
            }
        }
    }

    /* =============================================
      BORRAR
      ============================================= */

    static public function ctrBorrar() {

        if (isset($_GET["borrarRespaldos"])) {

            $tabla = "respaldos ";
            $datos = $_GET["idRespaldos"];

            $respuesta = ModeloRespaldos::mdlBorrar($tabla, $datos);

            if ($respuesta == "ok") {

                echo'<script>

    swal({
       type: "success",
       title: "Borrado correctamente",
       showConfirmButton: true,
       confirmButtonText: "Cerrar",
       closeOnConfirm: false
       }).then(function(result) {
        if (result.value) {

        window.location = "respaldos ";

        }
       })

    </script>';
            }
        }
    }
}

if(!isset($_SESSION["iniciarSesion"])){
    
    return;
}

// BUSCA Respaldos
if (isset($_POST["buscarRespaldos"])) {

    include '../modelos/respaldos.modelo.php';

    $valor = $_POST["idRespaldos"];

    $respuesta = ModeloRespaldos::mdlMostrar("respaldos", "id", $valor);

    echo json_encode($respuesta);
}



// BUSCA Respaldos
if (isset($_GET["UUDIRespaldo"])) {

    include '../modelos/respaldos.modelo.php';

    $valor = $_GET["UUDIRespaldo"];

    $respuesta = ModeloRespaldos::mdlMostrar("respaldos", "uuid", $valor);
    
    $filePath = $respuesta["archivo"];
    $fileName = "backup_" . $respuesta["uuid"];
    $sqlContent = file_get_contents($filePath);

    // 1. Limpiar cualquier búfer de salida previo (opcional pero recomendado)
    if (ob_get_level()) ob_end_clean();

    // 2. Configurar los encabezados
    header("Content-Type: application/sql");
    header("Content-Disposition: attachment; filename=\"" . $fileName . ".sql\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // 3. Imprimir el contenido del archivo
    // Si el contenido está en una variable:
    echo $sqlContent; 

    // O si el archivo ya existe físicamente:
    // readfile($rutaArchivo);

    // 4. Detener el script inmediatamente
    exit;
    }

