<?php

require_once "conexion.php";

class ModeloBitacora {
    /* =============================================
      MOSTRAR BITACORA
      ============================================= */

    static public function mdlMostrarBitacora($tabla, $request, $noLimit) {
        $db = Conexion::conectar();

        /* ===============================
          COLUMNAS PERMITIDAS (ORDEN)
          =============================== */
        $columnas = [
            0 => 'descripcion',
            1 => 'fecha',
            2 => 'usuario'
        ];

        /* ===============================
          ORDER BY
          =============================== */
        $orderBy = "ORDER BY fecha DESC";

        if (isset($request['order'][0])) {
            $colIndex = (int) $request['order'][0]['column'];
            $dir = $request['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';

            if (isset($columnas[$colIndex])) {
                $orderBy = "ORDER BY {$columnas[$colIndex]} $dir";
            }
        }

        /* ===============================
          LIMIT
          =============================== */
        $limit = "";
        if ($noLimit === "n" && isset($request['start'], $request['length'])) {
            $limit = "LIMIT :start, :length";
        }

        /* ===============================
          BUSQUEDA GLOBAL
          =============================== */
        $where = "WHERE 1=1";

        if (!empty($request['search']['value'])) {
            $where .= "
            AND (
                id LIKE :buscar
                OR descripcion LIKE :buscar
                OR fecha LIKE :buscar
                OR usuario LIKE :buscar
            )
        ";
        }

        /* ===============================
          QUERY
          =============================== */
        if ($noLimit === "s") {

            $sql = "
            SELECT COUNT(id) AS contador
            FROM $tabla
            $where
        ";

            $stmt = $db->prepare($sql);
        } else {

            $sql = "
            SELECT
                descripcion,
                fecha,
                usuario
            FROM $tabla
            $where
            $orderBy
            $limit
        ";

            $stmt = $db->prepare($sql);
        }

        /* ===============================
          BINDS
          =============================== */
        if (!empty($request['search']['value'])) {
            $stmt->bindValue(':buscar', '%' . $request['search']['value'] . '%');
        }

        if ($noLimit === "n" && isset($request['start'], $request['length'])) {
            $stmt->bindValue(':start', (int) $request['start'], PDO::PARAM_INT);
            $stmt->bindValue(':length', (int) $request['length'], PDO::PARAM_INT);
        }

        /* ===============================
          EJECUCIÓN
          =============================== */
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $stmt->errorInfo();
    }

    /* =============================================
      REGISTRO DE BITACORA
      ============================================= */

    static public function mdlIngresarBitacora($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
			 descripcion
			, usuario
			) 
			VALUES (:descripcion
			, :usuario
		)");

        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            $arr = $stmt->errorInfo();
            $arr[3] = "ERROR";
            return $arr[2];
        }

        $stmt->close();
        $stmt = null;
    }
}
