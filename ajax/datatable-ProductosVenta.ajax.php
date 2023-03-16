<?php

session_start();

if (!$_SESSION["id"]) {

    return;
}

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once "../modelos/ventas.modelo.php";

$idVenta = $_POST["idVenta"];

$venta = ModeloVentas::mdlMostrarVentas("ventas", "id", $idVenta);

if (count($venta) == 0) {

    echo '{"data": []}';

    return;
}

$productos = json_decode($venta["productos"], true);

	$datosJson = '{

		  "data": [';

foreach ($productos as $key => $value) {


    //   $cliente = ModeloClientes::mdlMostrarClientes("clientes", "id", $ventas[$i]["id_cliente"]);
    $datosJson .= '[
			      "' . $value["descripcion"] . '",
			      "' . $value["cantidad"] . '",
			      "' . $value["precio"] . '",
                              "' . $value["total"] . '"

			    ],';
}


$datosJson = substr($datosJson, 0, -1);

$datosJson .= ']

		 }';

echo $datosJson;
