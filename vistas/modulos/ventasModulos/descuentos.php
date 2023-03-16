<?php

/* 
 * Copyright (C) 2020 Julio Cesar Leyva Rodriguez
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */




?>
<!--=====================================
MODAL DESCUENTO PRODUCTOS
======================================-->

<div id="modalDescuento" class="modal fade cargaDescuento"  role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Descuento</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

              
                <div class="modal-body">

                    <div class="box-body">

                        <div class="row">
                            
                            <div class="col-md-7"><!-- comment -->
                                <select class="form-control select2 descuentoRenglon" id="descuentoRenglon" name="descuentoRenglon" required style="width: 100%;">

                                            <?php
                                                                                      
                                            $descuentosPorUsuario = ModeloDescuentos::mdlMostrarDescuentosPorUsuario($_SESSION["id"]);

                                          

                                                echo '<option value="-1" porcentaje="0">SIN DESCUENTO</opcion>';
                                            
                                            foreach ($descuentosPorUsuario as $id => $llave) {
                                                echo '<option value="' . $llave["id"] .'" porcentaje = "'. $llave["porcentaje"].'">' . $llave["descripcion"] . '</opcion>';
                                            }
                                            ?>


                                        </select>
                            </div>   
                            
                            
                              <div class="col-md-5">
                                  
                                  <input type="text" class="form-control decuentoImporteVisual" disabled id="decuentoImporteVisual" name="decuentoImporteVisual">
                              
                              </div>
 
                            
            
                        </div>
                            


                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                 

                </div>


            </form>


        </div>

    </div>

</div>


<script type="text/javascript">
    
    
    var nombreDiv ='';
    
    $(".descuentoRenglon").on("change",function(){
        
        console.log(nombreDiv);
        
        console.log("ID",$(this).val());
        
        
        var idDescuento = $(this).val();
        
        var porcentajeDescuento = $('option:selected', this).attr('porcentaje');
        
        console.log("PORCENTAJE:",porcentajeDescuento);
        
        
        
       if(idDescuento>0){
           
            $(".descuentoCliente").val("0");
            
            $(".descuentoGeneral").val("0");
            
            $(".descuentoGeneral").attr("disabled",true);

            $(".descuentoCliente").attr("disabled",true);
       
        }else{
            
            
          //   $(".descuentoCliente").removeAttr("disabled");
             $(".descuentoGeneral").removeAttr("disabled");
             $(".descuentoCliente").val("0");
            
        }
        
        
         console.log("***CAMBIA DESCUENTO");
         
         
         nombreDiv.parent().parent().find(".porcDescuento").val(porcentajeDescuento)
         nombreDiv.parent().parent().find(".idDescuento").val(idDescuento)
        

     

        total = Number( nombreDiv.parent().parent().find(".nuevoPrecioProducto").val());
        
        
        
       
        
        var descuento = total * (porcentajeDescuento*0.01);
        
        $(".decuentoImporteVisual").val(descuento);
        
  
         nombreDiv.parent().parent().find(".descuento").val(descuento);

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios()

        // AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()
        

        
        
        
    })
    
    
    /*=============================================
    CAMBIA DESCUENTO
    =============================================*/
    $(".modal-footer").on("click", ".btnCambiarDescuento", function () {
      
      
      
        console.log("***CAMBIA DESCUENTO");

        $(".formularioVenta ." +nombreDiv.attr("class")+" input.porcDescuento").val($("#descuentoRenglon").val());
        
       

        total = Number( $(".formularioVenta ." +nombreDiv.attr("class")+" input.nuevoPrecioProducto").val());
        porcDescuento = Number($("#descuentoRenglon").val());
        
        descuento = total * (porcDescuento*0.01);
        
        $(".formularioVenta ." +nombreDiv.attr("class")+" input.descuento").val(descuento);

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios()

        // AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()
        
        guardarVenta();

     
    })
    
    
     /*=============================================
    TRAER MONEDERO
     =============================================*/
    $(".nuevoProducto").on("click", ".obtenerDescuento", function () {
      
    
      
      nombreDiv = $(this).parent();
      
      var descuento = nombreDiv.parent().parent().find(".descuento").val();
      
      
      
      $(".decuentoImporteVisual").val("$ " + nombreDiv.parent().parent().find(".descuento").val());
      

    })
    
    
    /*=============================================
    CAMBIA VALOR MONEDERO
    =============================================*/
    $("#monederoUsado").on("keyup", function () {
       

       var monedasActuales =$("#modalImporteMonedero").val();
       var monedasUsuadas =$(this).val();
       
       console.log("monedas usuadas",monedasActuales);
       console.log("monederoUsado",monedasUsuadas)
       
       if(monedasUsuadas>monedasActuales){
           $("#monederoUsado").val(monedasActuales);
       }
       
        
    })
    
        $("#monederoUsado").on("change", function () {
       

       var monedasActuales =$("#modalImporteMonedero").val();
       var monedasUsuadas =$(this).val();
       
       console.log("monedas usuadas",monedasActuales);
       console.log("monederoUsado",monedasUsuadas)
       
       if(monedasUsuadas>monedasActuales){
           $("#monederoUsado").val(monedasActuales);
       }
       
        
    })
   
    /*=============================================
    TRAER MONEDERO
     =============================================*/
    $(".botonMonedero").on("click", ".btnTraerMonedero", function () {
      
       console.log("prueba");

        var uuid = $("#uuid").val();
        var idCliente = $("#seleccionarCliente").val();


        var datos = new FormData();
        datos.append("uuid", uuid);
        datos.append("idCliente", idCliente);
        datos.append("traerMonedero", "traerMonedero");
       
        $.ajax({

            url: "controladores/ventasBackEnd.controlador.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success: function (respuesta) {
               console.log("respuesta MONEDERO", respuesta);
                // ASIGNA VALOR AL MONEDERO
                
                $("#modalImporteMonedero").val(respuesta[0][0]);
               
            }

        })
        
        

    })
    
</script>