<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once "conexion.php";

class modeloVentasDetalle{
    
    
    /**
     * Funcioón para mostrar por idVenta
     * @param type $idVenta
     * @return type
     */
    
    public static function mdlMostrar($idVenta){
        
        
        $query = "SELECT
                    `id`,
                    `idVenta`,
                    `idProducto`,
                    `descripcion`,
                    `cantidad`,
                    `precio`,
                    `idDescuento`,
                    `descuento`,
                    `porcDescuento`,
                    `importeTotal`
                FROM
                    ventasdetalle
                WHERE
                  idVenta = :idVenta";
         
        $con = conexion::conectar()->prepare($query);
        
        $con->bindParam(":idVenta", $idVenta,PDO::PARAM_INT);
        
        try{
            
            $con->execute();
            
            return $con->fetchAll();
            
        } catch (PDOException $ex) {
            
            return $ex->getMessage();

        }
        
        
        
    }
    
    
    /**
     * Inserta en la tabla ventas detalle
     * @param type $datos
     * @return string
     */
    public static function mdlInsertar($datos){
        
        
        $query = "INSERT INTO `ventasdetalle`(
                                `idVenta`,
                                `idProducto`,
                                `descripcion`,
                                `cantidad`,
                                `precio`,
                                `idDescuento`,
                                `descuento`,
                                `porcDescuento`,
                                `importeTotal`
                            )
                            VALUES(
                                :idVenta,
                                :idProducto,
                                :descripcion,
                                :cantidad,
                                :precio,
                                :idDescuento,
                                :descuento,
                                :porcDescuento,
                                :importeTotal
                            );";
        
        $con = Conexion::conectar()->prepare($query);
        
        $con->bindParam(":idVenta", $datos["idVenta"],PDO::PARAM_INT);
        $con->bindParam(":idProducto", $datos["idProducto"],PDO::PARAM_INT);
        $con->bindParam(":descripcion", $datos["descripcion"],PDO::PARAM_STR);
        $con->bindParam(":cantidad", $datos["cantidad"],PDO::PARAM_INT);
        $con->bindParam(":precio", $datos["precio"],PDO::PARAM_INT);
        
        $con->bindParam(":idDescuento", $datos["idDescuento"],PDO::PARAM_STR);
        $con->bindParam(":descuento", $datos["descuento"],PDO::PARAM_STR);
        $con->bindParam(":porcDescuento", $datos["porcDescuento"],PDO::PARAM_STR);
        
        $con->bindParam(":importeTotal", $datos["importeTotal"],PDO::PARAM_INT);
        
        try{
            
            $con->execute();
            
            return "ok";
            
        } catch (PDOException $ex) {
            
            return $ex->getMessage();

        }
      

    }
    
    
    public static function mdlEliminar($idVenta){
        
        
        $query = "DELETE
                    FROM
                        ventasdetalle
                    WHERE
                        idVenta = :idVentas";
        
        $con = conexion::conectar()->prepare($query);
        
        $con->bindParam(":idVentas", $idVenta,PDO::PARAM_STR);
        
        try{
            
            $con->execute();
            
            return "ok";
            
        } catch (PDOException $ex) {

        }
        
    }
    
    
    
}
