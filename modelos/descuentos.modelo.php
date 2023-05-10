<?php

require_once "conexion.php";

class ModeloDescuentos
{
    /* =============================================
    MOSTRAR DESCUENTOS
    ============================================= */

    static public function mdlMostrar($tabla, $item, $valor)
    {

        if ($item != Null) {

            $stmt = Conexion::conectar()->prepare("Select id
,descripcion
,porcentaje
           From descuentos a WHERE $item =:$item ");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            try {
                $stmt->execute();

                return $stmt->fetch();
            } catch (PDOException $e) {

                $arr = $stmt->errorInfo();
                $arr[3] = " Error ";

                if ($e->getMessage() == 23000) {
                    $mensaje = " El registro esta duplicado, Favor de checar el numero de nomina ";
                    return $mensaje;
                } else {
                    return $arr[2];
                }
            }
        } else {

            $stmt = Conexion::conectar()->prepare("Select * 

           

           From descuentos a ");

            $stmt->execute();

            return $stmt->fetchAll();
        }


        $stmt->close();

        $stmt = Null;
    }

    /* ==================================================================
    REGISTRO
    ==================================================================== */

    static public function mdlIngresar($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO descuentos(descripcion
,porcentaje

        
                                                                       )
                                                                       VALUES(:descripcion
,:porcentaje
)
                          
                                                                              ");
        $stmt->bindParam(":descripcion", $datos["nuevoDescripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje", $datos["nuevoPorcentaje"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            $arr = $stmt->errorInfo();
            $arr[3] = " Error ";
            return $arr[2];
        }
        $stmt->close();
        $stmt = Null;
    }

    /* ==================================================================
    EDITAR
    ================================================================== */

    static public function mdlEditar($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare(" UPDATE $tabla SET descripcion= :descripcion,porcentaje= :porcentaje 
                                                                   WHERE id =:id  ");

        $stmt->bindParam(":id", $datos["editarId"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["editarDescripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":porcentaje", $datos["editarPorcentaje"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {
            return "Error";
        }
        $stmt->close();

        $stmt = Null;
    }

    /* ===================================================================
    BORRAR USUARIO
    =================================================================== */

    static public function mdlBorrar($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(" DELETE From descuentos WHERE id =:id ");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {
            return "Error";
        }
        $stmt->close();
        $stmt = Null;
    }

    public static function mdlMostrarDescuentosPorUsuario($idUsuario)
    {


        $query = "select a.id
                        ,a.descripcion
                        ,a.porcentaje
                    from descuentos a
                        , descuentos_por_usuario b
                    where a.id = b.idDescuento
                        and b.idUsuario =:idUsuario";

        $con = Conexion::conectar()->prepare($query);

        $con->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

        try {

            $con->execute();
            return $con->fetchAll();
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }


    public static function mdlDescuentosPorUsuario($idDescuento)
    {


        $query = "select a.id as idUsuario 
                        , a.usuario
                        , (select descripcion from descuentos where id = :idDescuento2) as descripcion
                        , ifnull((select b.estado from descuentos_por_usuario b 
                                  where a.id=b.idUsuario
                                           and b.idDescuento = :idDescuento
                                           and estado ='SI'
                                 ),'NO') as estado

                   from usuarios a;";

        $con = Conexion::conectar()->prepare($query);

        $con->bindParam(":idDescuento", $idDescuento, PDO::PARAM_STR);
        $con->bindParam(":idDescuento2", $idDescuento, PDO::PARAM_STR);

        try {

            $con->execute();

            return $con->fetchAll();
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }

    public static function mdlInsertarDescuentoUsuario($datos)
    {


        $query = "INSERT INTO `descuentos_por_usuario` ( `idUsuario`
                                                    , `idDescuento`
                                                    , `estado`) 
                                                    VALUES (:idUsuario
                                                    , :idDescuento
                                                    , :estado);";

        $con = Conexion::conectar()->prepare($query);

        $con->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
        $con->bindParam(":idDescuento", $datos["idDescuento"], PDO::PARAM_INT);
        $con->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

        try {

            $con->execute();

            return "ok";
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }

    /**
     * Actualiza Descuento por usuario
     *
     */
    public static function mdlActualizarDescuentoUsuario($datos)
    {

        $query = "UPDATE
                    descuentos_por_usuario
                SET
                    estado = :estado
                WHERE
                    idUsuario = :idUsuario
                    AND idDescuento = :idDescuento";

        $con = Conexion::conectar()->prepare($query);

        $con->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $con->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
        $con->bindParam(":idDescuento", $datos["idDescuento"], PDO::PARAM_STR);

        try {

            $con->execute();
            return "ok";
        } catch (PDOException $ex) {

            return $ex->getMessage();
        }
    }

    /**
     * DESCUENTOS POR USUARIOS
     */
    public static function mdlMostrarUsuariosPorDescuento($idUsuario, $idDescuento)
    {

        $query = "SELECT
                    id
                    ,idDescuento
                    ,idUsuario
                    ,estado
                FROM
                    descuentos_por_usuario
                WHERE
                    idUsuario = :idUsuario
                    AND idDescuento = :idDescuento";

        $con = Conexion::conectar()->prepare($query);

        $con->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
        $con->bindParam(":idDescuento", $idDescuento, PDO::PARAM_STR);

        try {

            $con->execute();

            return $con->fetchAll();
        } catch (PDOException $ex) {


            return $ex->getMessage();
        }
    }

}