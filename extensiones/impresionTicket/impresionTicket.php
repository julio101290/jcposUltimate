<?php
include_once "../../../configuracion.php";

require_once "../../controladores/ventas.controlador.php";
require_once "../../modelos/ventas.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

require_once "../../controladores/productos.controlador.php";
require_once "../../modelos/productos.modelo.php";

//DATOS EMPRESA

require_once "../../controladores/empresa.controlador.php";
require_once "../../modelos/empresa.modelo.php";

// https://parzibyte.github.io/ticket-js/3/
//DATOS DE LA EMPRESA
$DatosEmpresa = ControladorEmpresa::ctrMostrarEmpresas(null, null);

$nombreEmpresa = $DatosEmpresa[0]["NombreEmpresa"];
$direccionEmpresa = $DatosEmpresa[0]["DireccionEmpresa"];
$RFCEmpresa = $DatosEmpresa[0]["RFC"];
$TelefonoEmpresa = $DatosEmpresa[0]["Telefono"];

$logo = "data:image/png;base64," . $DatosEmpresa[0]["logo"];



$UUID = $_GET["UUID"];

$venta = ModeloVentas::mdlMostrarVentas("ventas", "UUID", $UUID);

$productos = json_decode($venta["productos"], true);
?>


<!DOCTYPE html>
<html><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="archivos/style.css">


    </head>

    <body>
        <div class="ticket"  style="width: 100%;">
            <img src="<?php echo $logo; ?>" alt="Logotipo" style="width: 140px;
                 max-width: 140px;display: block;
                 margin-left: auto;
                 margin-right: auto;
                 width: 50%;">
            <p class="centrado">TICKET DE VENTA
                <br><?php
                echo $direccionEmpresa;

                $time = time();

                echo date("Y/m/d (H:i:s)", $time);
                ?>
            <table class="center" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="cantidad">CANT</th>
                        <th class="producto">PRODUCTO</th>
                        <th class="precio">$$</th>
                    </tr>
                </thead>

                <tbody>

<?php
foreach ($productos as $key => $item) {
    echo '   
                 <tr>
                    <td class="cantidad">' . number_format($item["cantidad"], 2) . '</td>
                    <td class="producto">' . $item["descripcion"] . '</td>
                    <td class="precio">$' . number_format($item["precio"], 2) . '</td>
                </tr>';
}
?>

                </tbody>
            </table>

            <p class="derecha" style="font-size: 10px; font-weight: bold;">SUB TOTAL:$ <?php echo $venta["neto"]; ?> </p>
            <p class="derecha" style="font-size: 10px; font-weight: bold;">IVA:$ <?php echo $venta["impuesto"]; ?> </p>
            <p class="derecha" style="font-size: 10px; font-weight: bold;">TOTAL:$ <?php echo $venta["total"]; ?> </p>
            <p class="centrado">¡GRACIAS POR SU COMPRA!
                <br><?php echo $nombreEmpresa; ?></p>
        </div>



    </body></html>

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>


