
/*=============================================
EDITAR EMPRESA
=============================================*/
$(".tablas").on("click", ".btnEditarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");

  console.log("idEmpresa",idEmpresa);

	var datos = new FormData();
    datos.append("idEmpresa", idEmpresa);

    $.ajax({

      url:"ajax/empresa.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){


      	 
            $("#editarNombreEmpresa").val(respuesta["NombreEmpresa"]);
            $("#idEmpresa").val(respuesta["id"]);
            
            $("#editarDireccionEmpresa").val(respuesta["DireccionEmpresa"]);
            $("#editarRFC").val(respuesta["RFC"]);
            $("#editarTelefonoEmpresa").val(respuesta["Telefono"]);
            $("#editarCorreoElectronicoEmpresa").val(respuesta["correoElectronico"]);
            $("#editarDiasEntrega").val(respuesta["diasEntrega"]);
            
            $("#razonSocial").val(respuesta["razonSocial"]);
            $("#CURP").val(respuesta["CURP"]);
            $("#codigoPostal").val(respuesta["codigoPostal"]);
            $("#regimenFiscal").val(respuesta["regimenFiscal"]);
            
            $("#regimenFiscal").trigger("change");
            
            $(".previsualizarLogo").attr('src','data:image/png;base64, ' + respuesta["logo"]);
            

	  }

  	})

})
