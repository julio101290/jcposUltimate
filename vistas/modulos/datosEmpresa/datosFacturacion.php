    

<div class="form-group">



    <span class="input-group-addon">Razón Social</span> 

    <input  type="text" class="form-control input-lg razonSocial" id="razonSocial" name="razonSocial" value="" required placeholder="Ingresar Razón Social">



</div>

<div class="form-group">



    <span class="input-group-addon">RFC</span> 

    <input type="text" class="form-control input-lg" id="editarRFC" name="editarRFC" value="" required placeholder="Ingresar RFC">



</div>


<div class="form-group">



    <span class="input-group-addon">CURP</span> 

    <input type="text" class="form-control input-lg CURP" id="CURP" name="CURP" value="" required placeholder="Ingresar CURP">



</div>


<div class="form-group">



    <span class="input-group-addon">Código Postal</span> 

    <input type="text" class="form-control input-lg" id="codigoPostal" name="codigoPostal" value="" required placeholder="Código Postal">



</div>

<div class="form-group">



    <span class="input-group-addon">Regimen Fiscal</span> 

    <select class="form-control input-lg select2" name="regimenFiscal" id="regimenFiscal" style="width: 100%;">




        <?php
        /*
        $item = null;
        $valor = null;

        $regimenesFiscales = ModeloRegimenesFiscales::mdlMostrar("regimenesFiscales", null, null);

        foreach ($regimenesFiscales as $key => $value) {

            echo '<option value="' . $value["id"] . '">' . $value["Descripción"] . '</option>';
        }
         * 
         */
        ?>

    </select>



</div>


<!-- ENTRADA PARA CERTIFICADOS -->

<div class="form-group">

    <div class="panel">SUBIR CERTIFICADO</div>

    <input type="file" class="certificado" name="certificado" id="certificado">

    <p class="help-block">Peso máximo del archivo 10MB</p>



</div>

<!-- ENTRADA PARA ARCHIVO KEY -->

<div class="form-group">

    <div class="panel">SUBIR ARCHIVO KEY</div>

    <input type="file" class="archivoKey" name="archivoKey" id="archivoKey">

    <p class="help-block">Peso máximo del archivo 10MB</p>



</div>

<div class="form-group">



    <span class="input-group-addon">Contraseña Certificado</span> 

    <input type="text" class="form-control input-lg contraCertificado" id="contraCertificado" name="contraCertificado" value="" required placeholder="Código Postal">



</div>