<?php

function manejarAcciones(mysqli $conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $accion = $_POST['action'] ?? '';

        if ($accion == "registrar_movimiento"){
            registrarMovimiento($conn);
        }

        header("Location: movimientos.php");
        exit;
    }
}

function registrarMovimiento(mysqli $conn) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $proveedor_id = empty($_POST['proveedor_id']) ? 'NULL' : $_POST['proveedor_id'];
    $tipo = $_POST['tipo']; // 'Entrada' o 'Salida'
    $tipo_db = ($tipo == 'Entrada') ? 'INGRESO' : 'SALIDA';
    $motivo = $_POST['motivo'];

    // Insertar movimiento
    $sql_mov = "INSERT INTO movimientos (tipo, motivo, proveedor_id) VALUES ('$tipo_db', '$motivo', $proveedor_id)";
    mysqli_query($conn, $sql_mov);
    $movimiento_id = mysqli_insert_id($conn);

    // Insertar detalles_movimiento
    $sql_det = "INSERT INTO detalles_movimiento (movimiento_id, producto_id, cantidad) VALUES ($movimiento_id, $producto_id, $cantidad)";
    mysqli_query($conn, $sql_det);
}

function obtenerMovimientos(mysqli $conn) {
    $sql = "SELECT 
                CONCAT('#', LPAD(m.id, 3, '0')) as id,
                DATE_FORMAT(m.fecha, '%d/%m/%Y') AS fecha,
                CASE WHEN m.tipo = 'INGRESO' THEN 'Entrada' ELSE 'Salida' END AS tipo,
                IFNULL(pr.nombre, '—') AS proveedor,
                p.nombre AS producto,
                d.cantidad,
                IFNULL(m.motivo, '—') AS motivo
            FROM movimientos m
            JOIN detalles_movimiento d ON m.id = d.movimiento_id
            JOIN productos p ON d.producto_id = p.id
            LEFT JOIN proveedores pr ON m.proveedor_id = pr.id
            ORDER BY m.fecha DESC";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

function obtenerListaProductos(mysqli $conn) {
    $sql = "SELECT id, nombre, stock FROM productos ORDER BY nombre ASC";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

function obtenerListaProveedores(mysqli $conn) {
    $sql = "SELECT id, nombre FROM proveedores ORDER BY nombre ASC";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

?>
