<?php
session_start();

if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}

$carritos = '../productos/reciente.txt';

// Leer todas las líneas del archivo (si existe)
if (file_exists($carritos)) {
    $lineas = file($carritos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $lineas = [];
}

$lista_carrito = [];

// Leer y agrupar productos por nombre
foreach ($lineas as $linea) {
    $datos = explode('|', $linea);
    $nombre = trim($datos[0]);

    // Si ya está en el carrito, sumamos cantidad
    if (isset($lista_carrito[$nombre])) {
        $lista_carrito[$nombre];
    } else {
        $lista_carrito[$nombre] = [
            'nombre' => $nombre,
            'precio' => trim($datos[1]),
            'stock' => trim($datos[2]),
            'descripcion' => trim($datos[3]),
            'imagen' => trim($datos[4]),
            'cantidad' => 1,
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visto Recientemente</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .contenedor-carrito {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .producto {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        width: 260px;
        padding: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.2s ease;
    }

    .producto:hover {
        transform: translateY(-5px);
    }

    .producto img {
        width: 100%;
        height: 180px;
        border-radius: 8px;
        object-fit: cover;
    }

    .producto h2 {
        font-size: 18px;
        margin: 10px 0 5px 0;
        color: #333;
        text-align: center;
    }

    .producto p {
        font-size: 14px;
        color: #555;
        margin: 4px 0;
        text-align: center;
    }

    .cantidad {
        background: #e9ecef;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: bold;
        margin-top: 5px;
    }

    .boton-eliminar {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        margin-top: 10px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .boton-eliminar:hover {
        background: #c82333;
    }
</style>
</head>
<body>

<h1>🛒 Visto Recientemente</h1>

<div class="contenedor-carrito">
<?php
if (empty($lista_carrito)) {
    echo "<p style='text-align:center; width:100%; font-size:18px;'>Tu carrito está vacío.</p>";
} else {
    foreach ($lista_carrito as $p) {
        echo "<div class='producto'>";
        echo "<img src='{$p['imagen']}' alt='{$p['nombre']}'>";
        echo "<h2>{$p['nombre']}</h2>";
        echo "<p><strong>Precio:</strong> {$p['precio']}</p>";
        echo "<p><strong>Stock:</strong> {$p['stock']}</p>";
        echo "<p>{$p['descripcion']}</p>";
        echo "<p class='cantidad'>Cantidad: {$p['cantidad']}</p>";
        echo "<form action='../funciones/eliminar.php' method='post'>
            <input type='hidden' name='nombre' value='{$p['nombre']}'>
        </form>";
        echo "</div>";
    }
}
?>
</div>

<?php include '../include/footer.html'; ?>
</body>
</html>
