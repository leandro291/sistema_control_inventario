<?php
session_start();
require_once '../config/database.php';

$db = new Database();
$conn = $db->conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
        $res = mysqli_query($conn, $sql);
        
        if ($res && mysqli_num_rows($res) > 0) {
            $user = mysqli_fetch_assoc($res);
            if (password_verify($password, $user['password'])) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nombre'] = $user['nombre'];
                header("Location: ../index.php");
                exit;
            } else {
                header("Location: ../login.php?error=Contraseña incorrecta");
                exit;
            }
        } else {
            header("Location: ../login.php?error=Usuario no encontrado");
            exit;
        }
    } elseif ($action === 'registro') {
        $nombre = $_POST['nombre'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if user exists
        $check = mysqli_query($conn, "SELECT id FROM usuarios WHERE nombre = '$nombre'");
        if (mysqli_num_rows($check) > 0) {
            header("Location: ../registro.php?error=El nombre de usuario ya está registrado");
            exit;
        }

        $sql = "INSERT INTO usuarios (nombre, password) VALUES ('$nombre', '$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['usuario_id'] = mysqli_insert_id($conn);
            $_SESSION['usuario_nombre'] = $nombre;
            header("Location: ../index.php");
            exit;
        } else {
            header("Location: ../registro.php?error=Error al crear la cuenta");
            exit;
        }
    }
}
?>
