<?php
function getDashboardStats(mysqli $conn) {
    $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM productos");
    $total_productos = $res ? mysqli_fetch_assoc($res)['total'] : 0;

    $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM proveedores");
    $total_proveedores = $res ? mysqli_fetch_assoc($res)['total'] : 0;

    $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM movimientos WHERE tipo = 'INGRESO' AND DATE(fecha) = CURDATE()");
    $entradas_hoy = $res ? mysqli_fetch_assoc($res)['total'] : 0;

    $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM movimientos WHERE tipo = 'SALIDA' AND DATE(fecha) = CURDATE()");
    $salidas_hoy = $res ? mysqli_fetch_assoc($res)['total'] : 0;

    return [
        'total_productos' => $total_productos,
        'total_proveedores' => $total_proveedores,
        'entradas_hoy' => $entradas_hoy,
        'salidas_hoy' => $salidas_hoy
    ];
}

function getActividadReciente( mysqli$conn) {
    $sql = "SELECT m.tipo, d.cantidad, p.nombre as producto 
            FROM movimientos m 
            JOIN detalles_movimiento d ON m.id = d.movimiento_id 
            JOIN productos p ON d.producto_id = p.id 
            ORDER BY m.fecha DESC LIMIT 5";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

function getProductosStockBajo(mysqli $conn, $umbral = 10) {
    $sql = "SELECT nombre, stock FROM productos WHERE stock <= $umbral ORDER BY stock ASC LIMIT 5";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

function getMovimientosUltimos7Dias(mysqli $conn) {
    $sql = "
        SELECT 
            DATE(fecha) as dia,
            tipo,
            COUNT(*) as total
        FROM movimientos
        WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        GROUP BY DATE(fecha), tipo
        ORDER BY DATE(fecha) ASC
    ";
    $result = mysqli_query($conn, $sql);
    $rows = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];

    $data = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $data[$date] = ['INGRESO' => 0, 'SALIDA' => 0];
    }
    
    foreach ($rows as $row) {
        $dia = $row['dia'];
        if (isset($data[$dia])) {
            $data[$dia][$row['tipo']] = (int)$row['total'];
        }
    }

    $labels = [];
    $ingresos = [];
    $salidas = [];
    foreach ($data as $date => $totals) {
        $labels[] = date('d/m', strtotime($date));
        $ingresos[] = $totals['INGRESO'];
        $salidas[] = $totals['SALIDA'];
    }

    return [
        'labels' => $labels,
        'ingresos' => $ingresos,
        'salidas' => $salidas
    ];
}

function getTopProductosStock(mysqli $conn) {
    $sql = "SELECT nombre, stock FROM productos ORDER BY stock DESC LIMIT 5";
    $result = mysqli_query($conn, $sql);
    $rows = $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
    
    $labels = [];
    $data = [];
    foreach ($rows as $row) {
        $labels[] = $row['nombre'];
        $data[] = (int)$row['stock'];
    }

    return [
        'labels' => $labels,
        'data' => $data
    ];
}
?>
