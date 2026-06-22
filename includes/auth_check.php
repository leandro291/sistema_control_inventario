<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    $login_url = isset($is_root) && $is_root ? 'login.php' : '../login.php';
    header("Location: " . $login_url);
    exit;
}
?>
