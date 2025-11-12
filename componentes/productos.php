<?php
session_start();

// Mostrar mensajes de éxito o error (si existen)
if (isset($_SESSION['mensajeExito'])) {
    $mensajeExito = $_SESSION['mensajeExito'];
    unset($_SESSION['mensajeExito']); 
}

if (isset($_SESSION['mensajeError'])) {
    $mensajeError = $_SESSION['mensajeError'];
    unset($_SESSION['mensajeError']);
}

// Mostrar header según el usuario
if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}

// Leer productos
$productos = '../productos/productos.txt';
$lineas = file($productos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$lista_productos = [];

foreach ($lineas as $linea) {
    $datos = explode('|', $linea);
    $producto = [
        'nombre' => trim($datos[0]),
        'precio' => trim($datos[1]),
        'stock' => trim($datos[2]),
        'descripcion' => trim($datos[3]),
        'imagen' => trim($datos[4]),
    ];
    $lista_productos[] = $producto;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catálogo de Productos</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    /* Mensajes */
    .mensaje {
        text-align: center;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 8px;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    .exito {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Contenedor general */
    .contenedor-productos {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    /* Tarjeta de producto */
    .producto {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        width: 240px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px;
    }

    .producto:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    .producto img {
        border-radius: 8px;
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .producto h2 {
        font-size: 18px;
        margin: 10px 0 5px 0;
        color: #333;
        text-align: center;
    }

    .producto p {
        margin: 3px 0;
        font-size: 14px;
        color: #555;
        text-align: center;
    }

    .producto button {
        margin-top: 10px;
        padding: 8px 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .producto button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<h1>Catálogo de Productos</h1>

<!-- Mostrar mensajes si existen -->
<?php if (isset($mensajeExito)): ?>
    <div class="mensaje exito"><?php echo htmlspecialchars($mensajeExito); ?></div>
<?php endif; ?>

<?php if (isset($mensajeError)): ?>
    <div class="mensaje error"><?php echo htmlspecialchars($mensajeError); ?></div>
<?php endif; ?>

<!-- Contenedor de productos -->
<div class="contenedor-productos">
<?php
foreach ($lista_productos as $p) {
?>
    <form action="../procedimientos/carrito.proc.php" method="post">
        <div class="producto">
            <img src="<?php echo $p['imagen']; ?>" alt="<?php echo $p['nombre']; ?>">
            <h2><?php echo $p['nombre']; ?></h2>
            <p><strong>Precio:</strong> <?php echo $p['precio']; ?></p>
            <p><strong>Stock:</strong> <?php echo $p['stock']; ?></p>
            <p><?php echo $p['descripcion']; ?></p>

            <!-- Campos ocultos -->
            <input type="hidden" name="nombre" value="<?php echo $p['nombre']; ?>">
            <input type="hidden" name="precio" value="<?php echo $p['precio']; ?>">
            <input type="hidden" name="stock" value="<?php echo $p['stock']; ?>">
            <input type="hidden" name="descripcion" value="<?php echo $p['descripcion']; ?>">
            <input type="hidden" name="imagen" value="<?php echo $p['imagen']; ?>">

            <button type="submit">Agregar al carrito 🛒</button>
        </div>
    </form>
<?php
}
?>
</div>

<?php include '../include/footer.html'; ?>
</body>
</html>
