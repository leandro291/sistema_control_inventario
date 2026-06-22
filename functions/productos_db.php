<?php


function manejarAcciones(mysqli $conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $accion = $_POST['action'] ?? '';

        if ($accion == "registrar_categoria"){
            registrarCategoria($conn);
        }
        elseif ($accion ==  "registrar_marca"){
            registrarMarca($conn);
        }
        elseif ($accion == "registrar_producto"){
            registrarProducto($conn);
        }
        elseif ($accion == "registrar_zona"){
            registrarZona($conn);
        }

        header("Location: productos.php");
        exit;
    }
}

function registrarCategoria(mysqli $conn) {

    $nombre_categoria = $_POST['nombre_categoria'];
    $consulta = "INSERT INTO categorias (nombre) VALUES ('$nombre_categoria')";
    mysqli_query($conn, $consulta);
}

function registrarMarca(mysqli $conn){
    $nombre_marca = $_POST['nombre_marca'];
    $consulta = "INSERT INTO marcas (nombre) VALUES ('$nombre_marca')";
    mysqli_query($conn, $consulta);
}

function registrarZona(mysqli $conn){
    $nombre_zona = $_POST['nombre_zona'];
    $consulta = "INSERT INTO zonas_almacen (nombre) VALUES ('$nombre_zona')";
    mysqli_query($conn, $consulta);
}

function registrarProducto(mysqli $conn){
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $stock_producto = $_POST['stock_producto'];
    $categoria_producto = $_POST['categoria_producto'];
    $marca_producto = $_POST['marca_producto'];
    $zona_producto = $_POST['zona_producto'];

    $consulta = "INSERT INTO productos (nombre, precio, stock, categoria_id, marca_id, zona_id) 
                VALUES ('$nombre_producto', '$precio_producto', '$stock_producto', '$categoria_producto', '$marca_producto', '$zona_producto')";
    mysqli_query($conn, $consulta);
}   

function obtenerCategorias(mysqli $conn) {
    $sql = "SELECT id, nombre FROM categorias";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

function obtenerMarcas(mysqli $conn) {
    $sql = "SELECT id, nombre FROM marcas";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

function obtenerZonas(mysqli $conn) {
    $sql = "SELECT id, nombre FROM zonas_almacen ";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

function obtenerProductos(mysqli $conn) {
    $sql = "SELECT 
                p.id, 
                p.nombre,
                p.precio,
                p.stock,
                cat.nombre AS categoria,
                m.nombre AS marca,
                z.nombre AS zona
            FROM productos p
            JOIN categorias cat ON cat.id = p.categoria_id
            JOIN marcas m ON m.id = p.marca_id
            JOIN zonas_almacen z ON z.id = p.zona_id";
    $result = mysqli_query($conn, $sql);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}
?>
