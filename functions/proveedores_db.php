<?php

function manejarAcciones(mysqli $conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $accion = $_POST['action'] ?? '';

        if ($accion == "registrar_proveedor"){
            registrarProveedor($conn);
        }
        elseif ($accion == "editar_proveedor"){
            editarProveedor($conn);
        }
        elseif ($accion == "eliminar_proveedor"){
            eliminarProveedor($conn);
        }

        header("Location: proveedores.php");
        exit;
    }
}

function registrarProveedor(mysqli $conn) {
    $ruc = $_POST['ruc'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    $stmt = $conn->prepare("INSERT INTO proveedores (ruc_dni, nombre, correo) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $ruc, $nombre, $correo);
    $stmt->execute();
    $stmt->close();
}

function editarProveedor(mysqli $conn) {
    $id = $_POST['id_proveedor'];
    $ruc = $_POST['ruc'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    $stmt = $conn->prepare("UPDATE proveedores SET ruc_dni=?, nombre=?, correo=? WHERE id=?");
    $stmt->bind_param("sssi", $ruc, $nombre, $correo, $id);
    $stmt->execute();
    $stmt->close();
}

function eliminarProveedor(mysqli $conn) {
    $id = $_POST['id_proveedor'];
    
    $stmt = $conn->prepare("UPDATE proveedores SET estado = 0 WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function obtenerProveedores(mysqli $conn) {
    $sql = "SELECT id, ruc_dni, nombre, correo FROM proveedores WHERE estado = 1";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}
?>
