<?php

class impimirCodigoBarras {

    public $idProducto;

    public function traerCodigoBarras() {

        ini_set('display_errors', 0);
        ini_set('log_errors', 1);

//TRAEMOS LA INFORMACIÓN DE LA VENTA


        $idProducto = $this->idProducto;

//REQUERIMOS LA CLASE TCPDF

        require_once('tcpdf_include.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage('P', 'A7');

// define barcode style
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 12,
            'stretchtext' => 4
        );

        $pdf->Cell(0, 0, 'BAR CODE', 0, 1);
        $pdf->write1DBarcode($idProducto, 'S25', '', '', '', 18, 0.4, $style, 'N');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 
//$pdf->Output('factura.pdf', 'D');
        $pdf->Output('codigoBarrasCliente.pdf');
    }

}

$codigoBarras = new impimirCodigoBarras();
$codigoBarras->idProducto = $_GET["idProducto"];
$codigoBarras->traerCodigoBarras();
?>
