<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of empresas
 *
 * @author julio
 */
include_once "conexion.php";

class ModeloEmpresas2 {

    public $id;
    public $NombreEmpresa;
    public $DireccionEmpresa;
    public $RFC;
    public $Telefono;
    public $correoElectronico;
    public $diasEntrega;
    public $regimenFiscal;
    public $razonSocial;
    public $codigoPostal;
    public $CURP;
    public $logo;
    public $certificado;
    public $archivoKey;
    public $contraCertificado;
    public $contraEmpresa;

    /**
     * Mostrar Empresa
     * @param PDO $con
     * @return type
     */
    public function mdlMostrarEmpresa(PDO $con = null) {

        $query = "SELECT
                    id,
                    NombreEmpresa,
                    DireccionEmpresa,
                    RFC,
                    Telefono,
                    correoElectronico,
                    diasEntrega,
                    regimenFiscal,
                    razonSocial,
                    codigoPostal,
                    CURP,
                    to_base64(logo) as logo,
                   
                    
                    contraCertificado,
                    contraEmpresa

                    from datosempresa
                    where id = :id";

        if ($con == null) {

            $con = Conexion::conectar()->prepare($query);
        } else {

            $con = $con->prepare($query);
        }

        $con->bindParam(":id", $this->id, PDO::PARAM_STR);

        try {

            $con->execute();

            $resultado = $con->fetch();

            $this->id = $resultado['id'];
            $this->NombreEmpresa = $resultado['NombreEmpresa'];
            $this->DireccionEmpresa = $resultado['DireccionEmpresa'];
            $this->RFC = $resultado['RFC'];
            $this->Telefono = $resultado['Telefono'];
            $this->correoElectronico = $resultado['correoElectronico'];
            $this->diasEntrega = $resultado['diasEntrega'];
            $this->regimenFiscal = $resultado['regimenFiscal'];
            $this->razonSocial = $resultado['razonSocial'];
            $this->codigoPostal = $resultado['codigoPostal'];
            $this->CURP = $resultado['CURP'];
            $this->logo = $resultado['logo'];
            $this->certificado = $resultado['certificado'];
            $this->archivoKey = $resultado['archivoKey'];
            $this->contraCertificado = $resultado['contraCertificado'];
            $this->contraEmpresa = $resultado['contraEmpresa'];

            return $resultado;
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }

    /**
     * Muestra todas las empresas
     * @param PDO $con
     * @return type
     */
    public function mdlMostrarEmpresas(PDO $con = null) {

        $query = "SELECT
                    id,
                    NombreEmpresa,
                    DireccionEmpresa,
                    RFC,
                    Telefono,
                    correoElectronico,
                    diasEntrega,
                    regimenFiscal,
                    razonSocial,
                    codigoPostal,
                    CURP,
                    logo,
                    certificado,
                    archivoKey,
                    contraCertificado,
                    contraEmpresa

                    from datosempresa
                    ";

        if ($con == null) {

            $con = Conexion::conectar()->prepare($query);
        } else {

            $con = $con->prepare($query);
        }



        try {

            $con->execute();

            $resultado = $con->fetchAll();

            return $resultado;
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }

    /**
     * Insertamos datos en la tabla em
     * @param PDO $con
     * @return string
     */
    public function mdlInsertar(PDO $con = null) {

        $query = "INSERT INTO datosempresa(
                            NombreEmpresa,
                            DireccionEmpresa,
                            RFC,
                            Telefono,
                            correoElectronico,
                            diasEntrega,
                            regimenFiscal,
                            razonSocial,
                            codigoPostal,
                            CURP,";
        if ($this->logo != null) {
            $query .= "         logo,";
        }

        if ($this->certificado != null) {
            $query .= "                   certificado,";
        }


        if ($this->archivoKey != null) {
            $query .= "               archivoKey,";
        }
        $query .= "                 contraCertificado,
                            contraEmpresa
                        )
                        VALUES  (
                            :nombreEmpresa,
                            :direccionEmpresa,
                            :RFC,
                            :telefono,
                            :correoElectronico,
                            
                            :diasEntrega,
                            :regimenFiscal,
                            :razonSocial,
                            :codigoPostal,
                            :CURP,";
        if ($this->logo != null) {

            $query .= "         :logo,";
        }

        if ($this->certificado != null) {

            $query .= " :certificado,";
        }
        if ($this->archivoKey != null) {
            $query .= "                 :archivoKey,";
        }
        $query .= "                  :contraCertificado,
                            :contraEmpresa
                        );";

        if ($con == null) {

            $con = Conexion::conectar()->prepare($query);
        } else {

            $con = $con->prepare($query);
        }

        $con->bindParam(":nombreEmpresa", $this->NombreEmpresa, PDO::PARAM_STR);
        $con->bindParam(":direccionEmpresa", $this->DireccionEmpresa, PDO::PARAM_STR);
        $con->bindParam(":RFC", $this->RFC, PDO::PARAM_STR);
        $con->bindParam(":telefono", $this->Telefono, PDO::PARAM_STR);
        $con->bindParam(":correoElectronico", $this->correoElectronico, PDO::PARAM_STR);

        $con->bindParam(":diasEntrega", $this->diasEntrega, PDO::PARAM_STR);
        $con->bindParam(":regimenFiscal", $this->regimenFiscal, PDO::PARAM_STR);
        $con->bindParam(":razonSocial", $this->razonSocial, PDO::PARAM_STR);
        $con->bindParam(":codigoPostal", $this->razonSocial, PDO::PARAM_STR);
        $con->bindParam(":CURP", $this->CURP, PDO::PARAM_STR);

        if ($this->logo != null) {
            $con->bindParam(":logo", $this->logo, PDO::PARAM_LOB);
        }

        if ($this->certificado != null) {

            $con->bindParam(":certificado", $this->logo, PDO::PARAM_LOB);
        }

        if ($this->archivoKey != null) {
            $con->bindParam(":archivoKey", $this->archivoKey, PDO::PARAM_LOB);
        }
        $con->bindParam(":contraCertificado", $this->contraCertificado, PDO::PARAM_STR);
        $con->bindParam(":contraEmpresa", $this->contraEmpresa, PDO::PARAM_STR);

        try {

            $con->execute();

            return "ok";
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }

    /**
     * Actualiza Empresa
     * @param PDO $con
     * @return string
     */
    public function mdlActualizar(PDO $con = null) {



        $query = "UPDATE
                    datosempresa
                SET
                    NombreEmpresa = :nombreEmpresa,
                    DireccionEmpresa = :direccionEmpresa,
                    RFC = :RFC,
                    Telefono =  :telefono,
                    correoElectronico = :correoElectronico,
                    
                    diasEntrega = :diasEntrega,
                    regimenFiscal = :regimenFiscal,
                    razonSocial = :razonSocial,
                    codigoPostal = :codigoPostal,
                    CURP = :CURP,";
        if ($this->logo != null) {


            $query .= "    logo = :logo,";
        }

        if ($this->certificado != null) {

            $query .= "              certificado = :certificado,";
        }


        if ($this->archivoKey != null) {
            $query .= "            archivoKey = :archivoKey,";
        }

        $query .= "            contraCertificado = :contraCertificado,
                    contraEmpresa = :contraEmpresa
                WHERE
                    id = :id";

        if ($con == null) {

            $con = Conexion::conectar()->prepare($query);
        } else {

            $con = $con->prepare($query);
        }

        $con->bindParam(":id", $this->id, PDO::PARAM_STR);
        $con->bindParam(":nombreEmpresa", $this->NombreEmpresa, PDO::PARAM_STR);
        $con->bindParam(":direccionEmpresa", $this->DireccionEmpresa, PDO::PARAM_STR);
        $con->bindParam(":RFC", $this->RFC, PDO::PARAM_STR);
        $con->bindParam(":telefono", $this->Telefono, PDO::PARAM_STR);

        $con->bindParam(":correoElectronico", $this->correoElectronico, PDO::PARAM_STR);
        $con->bindParam(":diasEntrega", $this->diasEntrega, PDO::PARAM_STR);
        $con->bindParam(":regimenFiscal", $this->regimenFiscal, PDO::PARAM_STR);
        $con->bindParam(":razonSocial", $this->razonSocial, PDO::PARAM_STR);
        $con->bindParam(":codigoPostal", $this->codigoPostal, PDO::PARAM_STR);
        $con->bindParam(":CURP", $this->CURP, PDO::PARAM_STR);

        if ($this->logo != null) {
            $con->bindParam(":logo", $this->logo, PDO::PARAM_LOB);
        }

        if ($this->certificado != null) {
            $con->bindParam(":certificado", $this->certificado, PDO::PARAM_LOB);
        }
        if ($this->archivoKey != null) {
            $con->bindParam(":archivoKey", $this->archivoKey, PDO::PARAM_LOB);
        }

        $con->bindParam(":contraCertificado", $this->contraCertificado, PDO::PARAM_STR);
        $con->bindParam(":contraEmpresa", $this->contraEmpresa, PDO::PARAM_STR);

        try {

            $con->execute();

            return "ok";
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }

    /**
     * Elimina Empresa
     * @param PDO $con
     * @return string
     */
    public function mdlEliminar(PDO $con = null) {

        $query = "delete

                    from datosempresa
                    where id = :id";

        if ($con == null) {

            $con = Conexion::conectar()->prepare($query);
        } else {

            $con = $con->prepare($query);
        }

        $con->bindParam(":id", $this->id, PDO::PARAM_STR);

        try {

            $con->execute();

            return "ok";
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }

}
