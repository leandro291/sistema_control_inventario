<?php

function manejarAcciones(mysqli $conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $accion = $_POST['action'] ?? '';

        if ($accion == "registrar_proveedor"){
            registrarProveedor($conn);
        }

        header("Location: proveedores.php");
        exit;
    }
}

function registrarProveedor(mysqli $conn) {
    $ruc = $_POST['ruc'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    $consulta = "INSERT INTO proveedores (ruc_dni, nombre, correo) VALUES ('$ruc', '$nombre', '$correo')";
    mysqli_query($conn, $consulta);
}

function obtenerProveedores(mysqli $conn) {
    $sql = "SELECT id, ruc_dni, nombre, correo FROM proveedores";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}
?>
