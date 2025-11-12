<php
$productos = '../productos/productos.txt';

$lineas = file($productos);

foreach ($lineas as $linea) {
    $datos = explode('|', $linea);
    $nombre = $datos[0];
    $precio = $datos[1];
    $stock = $datos[2];
    $descripcion = $datos[3];
    $imagen = $datos[4];
    echo "<div class='producto'>";
    echo "<img src='productos/$imagen' alt='$nombre'>";
    echo "<h2>$nombre</h2>";
    echo "<p>$precio</p>";
    echo "<p>$stock</p>";
    echo "<p>$descripcion</p>";
    echo "</div>";
}

?>