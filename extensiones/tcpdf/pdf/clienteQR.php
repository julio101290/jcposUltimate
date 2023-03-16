<?php

class impimirCodigoBarras {

    public $idCliente;

    public function traerCodigoBarras() {

        ini_set('display_errors', 0);
        ini_set('log_errors', 1);

//TRAEMOS LA INFORMACIÓN DE LA VENTA


        $idCliente = $this->idCliente;

//REQUERIMOS LA CLASE TCPDF

        require_once('tcpdf_include.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage('P', 'A7');

// define barcode style
// set style for barcode
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);



// QRCODE,M : QR-CODE Medium error correction
$pdf->write2DBarcode($idCliente , 'QRCODE,M', 14, 10, 50, 50, $style, 'N');
$pdf->Text(28, 65, 'ID '.$idCliente);
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 
//$pdf->Output('factura.pdf', 'D');
        $pdf->Output('codigoBarrasCliente.pdf');
    }

}




$codigoBarras = new impimirCodigoBarras();
$codigoBarras->idCliente = $_GET["idCliente"];
$codigoBarras->traerCodigoBarras();
?>
