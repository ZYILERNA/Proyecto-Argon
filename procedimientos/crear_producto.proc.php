<?php
session_start();

// Solo usuarios logueados pueden crear productos
if (!isset($_SESSION['usuario'])) {
    header("Location: ../componentes/login.php");
    exit;
}

// Recoger datos del formulario
$nombre = trim($_POST['nombre']);
$precio = trim($_POST['precio']);
$stock = trim($_POST['stock']);
$descripcion = trim($_POST['descripcion']);
$imagen = trim($_POST['imagen']);

// Carpeta por defecto para imágenes
$carpeta_imagen = '../imagenes/';

// Si no escribieron ruta completa, agregamos carpeta por defecto
if ($imagen === '') {
    $imagen = $carpeta_imagen . 'default.jpg'; // imagen por defecto
} elseif (strpos($imagen, '/') === false) {
    $imagen = $carpeta_imagen . $imagen;
}

// Validación mínima
if (empty($nombre) || empty($precio) || empty($stock) || empty($descripcion)) {
    $_SESSION['mensajeError'] = "Todos los campos excepto la imagen son obligatorios.";
    header("Location: ../componentes/crear_producto.php");
    exit;
}

// Preparar línea para el txt
$linea = "$nombre|$precio|$stock|$descripcion|$imagen" . "\n"; // <-- SALTO DE LÍNEA

// Guardar en productos.txt
$archivo = '../productos/productos.txt';
if (file_put_contents($archivo, $linea, FILE_APPEND)) {
    $_SESSION['mensajeExito'] = "Producto creado correctamente.";
} else {
    $_SESSION['mensajeError'] = "Error al guardar el producto.";
}

// Redirigir al catálogo
header("Location: ../componentes/productos.php");
exit;
?>
