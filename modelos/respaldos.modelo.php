<?php

require_once "conexion.php";

Class ModeloRespaldos {
    /* =============================================
      MOSTRAR RESPALDOS
      ============================================= */

    Static Public Function mdlMostrar($tabla, $item, $valor) {

        If ($item != Null) {

            $stmt = Conexion::conectar()->prepare("Select id
                ,descripcion
                ,archivo
                ,uuid
                From respaldos a WHERE $item =:$item ");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            Try {
                $stmt->execute();

                Return $stmt->fetch();
            } Catch (PDOException $e) {

                $arr = $stmt->errorInfo();
                $arr[3] = " Error ";

                If ($e->getMessage() == 23000) {
                    $mensaje = " El registro esta duplicado, Favor de checar el numero de nomina ";
                    Return $mensaje;
                } Else {
                    Return $arr[2];
                }
            }
        } Else {

            $stmt = Conexion::conectar()->prepare("Select * 

           

           From respaldos a ");

            $stmt->execute();

            Return $stmt->fetchAll();
        }


        $stmt->close();

        $stmt = Null;
    }

    /* ==================================================================
      REGISTRO
      ==================================================================== */

    Static Public Function mdlIngresar($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO respaldos(descripcion
                                                                    ,archivo
                                                                    ,uuid


                                                                       )
                                                                       VALUES(:descripcion
                                                                        ,:archivo
                                                                        ,:uuid
                                                                            )
                          
                                                                              ");
        $stmt->bindParam(":descripcion", $datos["nuevoDescripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":archivo", $datos["nuevoArchivo"], PDO::PARAM_STR);
        $stmt->bindParam(":uuid", $datos["nuevoUuid"], PDO::PARAM_STR);

        If ($stmt->execute()) {

            Return "ok";
        } Else {

            $arr = $stmt->errorInfo();
            $arr[3] = " Error ";
            Return $arr[2];
        }
        $stmt->close();
        $stmt = Null;
    }

    /* ==================================================================
      EDITAR
      ================================================================== */

    Static Public Function mdlEditar($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(" UPDATE $tabla SET descripcion= :descripcion,archivo= :archivo,uuid= :uuid 
                                                                   WHERE id =:id  ");

        $stmt->bindParam(":id", $datos["editarId"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["editarDescripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":archivo", $datos["editarArchivo"], PDO::PARAM_STR);
        $stmt->bindParam(":uuid", $datos["editarUuid"], PDO::PARAM_STR);

        If ($stmt->execute()) {

            Return "ok";
        } Else {
            Return "Error";
        }
        $stmt->close();

        $stmt = Null;
    }

    /* ===================================================================
      BORRAR USUARIO
      =================================================================== */

    Static Public Function mdlBorrar($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare(" DELETE From respaldos WHERE id =:id ");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        If ($stmt->execute()) {

            Return "ok";
        } Else {
            Return "Error";
        }
        $stmt->close();
        $stmt = Null;
    }
}
