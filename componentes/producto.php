<?php
include '../include/hlogin.html';

$productos = '../productos/productos.txt';

// Leer todas las líneas del archivo
$lineas = file($productos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Crear un array vacío
$lista_productos = [];

foreach ($lineas as $linea) {
    // Dividir cada línea por el separador |
    $datos = explode('|', $linea);

    // Crear un array asociativo para cada producto
    $producto = [
        'nombre' => trim($datos[0]),
        'precio' => trim($datos[1]),
        'stock' => trim($datos[2]),
        'descripcion' => trim($datos[3]),
        'imagen' => trim($datos[4]),
    ];

    // Agregarlo al array principal
    $lista_productos[] = $producto;
}

// --- Ejemplo: mostrar los productos ---
foreach ($lista_productos as $p) {
    echo "<div class='producto'style='display: flex;'>";
    echo "<img src='{$p['imagen']}' alt='{$p['nombre']}' width='100px' height='100px'>";
    echo "<h2>{$p['nombre']}</h2>";
    echo "<p>Precio: {$p['precio']}</p>";
    echo "<p>Stock: {$p['stock']}</p>";
    echo "<p>{$p['descripcion']}</p>";
    echo "<button>Agregar al carrito</button>";
    echo "</div>";
}
?>
