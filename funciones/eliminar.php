<?php
session_start();

$archivo_carrito = '../productos/carrito.txt';
$nombreProd = trim($_REQUEST['nombre']);

// Leer el archivo
if (file_exists($archivo_carrito)) {
    $lineas = file($archivo_carrito, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$lineas_filtradas = [];
$encontrado = false;

// Recorrer las líneas
foreach ($lineas as $linea) {
    $datos = explode('|', $linea);
    
    // Validar que la línea tenga datos
    if (count($datos) > 0) {
        $nombre = trim($datos[0]);
        
        // Si no coincide, guardar la línea
        if ($nombre !== $nombreProd) {
            $lineas_filtradas[] = $linea;
        } else {
            $encontrado = true; // Encontrado
        }
    }
}

// Guardar el archivo actualizado (sin el producto eliminado)
file_put_contents($archivo_carrito, implode("\n", $lineas_filtradas) . "\n");


// Redirige al carrito
header('Location: ../componentes/carrito.php');
exit();
?>