<?php
session_start();

if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}
$usuario = basename($_SESSION['usuario']);

$carritos = "../productos/carrito_" . $usuario . ".txt";

// Leer todas las líneas del archivo (si existe)
if (file_exists($carritos)) {
    $lineas = file($carritos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $lineas = [];
}

$lista_carrito = [];
$total = 0;

// Leer y agrupar productos por nombre
foreach ($lineas as $linea) {
    $datos = explode('|', $linea);
    $nombre = trim($datos[0]);
    $precio = (float)str_replace(['€', ','], ['', '.'], trim($datos[1]));

    // Si ya está en el carrito, sumamos cantidad
    if (isset($lista_carrito[$nombre])) {
        $lista_carrito[$nombre]['cantidad']++;
    } else {
        $lista_carrito[$nombre] = [
            'nombre' => $nombre,
            'precio' => trim($datos[1]),
            'precio_num' => $precio,
            'stock' => trim($datos[2]),
            'descripcion' => trim($datos[3]),
            'imagen' => trim($datos[4]),
            'cantidad' => 1,
        ];
    }
    $total += $precio;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mi Carrito - La Huerta Fresca</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero-section {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .cart-card {
        transition: transform 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .cart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    }

    .cart-img {
        height: 150px;
        object-fit: cover;
    }

    .quantity-badge {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: bold;
        display: inline-block;
    }

    .btn-remove {
        background: linear-gradient(135deg, #f44336, #d32f2f);
        border: none;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-remove:hover {
        background: linear-gradient(135deg, #d32f2f, #c62828);
        transform: scale(1.05);
    }

    .total-card {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .empty-cart {
        padding: 4rem 0;
        text-align: center;
    }

    .empty-cart i {
        font-size: 5rem;
        color: #ccc;
    }
</style>
<?php  include '../include/color_fondo.php'?>
</head>
<body>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-cart-fill"></i> Mi Carrito de Compra
        </h1>
        <p class="lead">Revisa tus productos seleccionados</p>
    </div>
</div>

<div class="container mb-5">
    <?php if (empty($lista_carrito)): ?>
        <!-- Carrito vacío -->
        <div class="empty-cart">
            <i class="bi bi-cart-x"></i>
            <h2 class="mt-4 text-muted">Tu carrito está vacío</h2>
            <p class="text-muted mb-4">¡Añade algunos productos frescos!</p>
            <a href="../componentes/productos.php" class="btn btn-success btn-lg">
                <i class="bi bi-basket3"></i> Ver Productos
            </a>
        </div>
    <?php else: ?>
        <div class="row">
            <!-- Columna de productos -->
            <div class="col-lg-8 mb-4">
                <div class="row g-3">
                    <?php foreach ($lista_carrito as $p): ?>
                        <div class="col-12">
                            <div class="card cart-card">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="<?php echo htmlspecialchars($p['imagen']); ?>" 
                                             class="img-fluid cart-img w-100" 
                                             alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="card-title fw-bold mb-2">
                                                        <?php echo htmlspecialchars($p['nombre']); ?>
                                                    </h5>
                                                    <p class="card-text text-muted small mb-2">
                                                        <?php echo htmlspecialchars($p['descripcion']); ?>
                                                    </p>
                                                    <p class="mb-2">
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-box-seam"></i> Stock: <?php echo htmlspecialchars($p['stock']); ?>
                                                        </span>
                                                    </p>
                                                    <p class="mb-2">
                                                        <span class="quantity-badge">
                                                            <i class="bi bi-basket"></i> Cantidad: <?php echo $p['cantidad']; ?>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="text-end">
                                                    <p class="h4 text-success fw-bold mb-3">
                                                        <?php echo htmlspecialchars($p['precio']); ?>
                                                    </p>
                                                    <form action="../funciones/eliminar.php" method="post">
                                                        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($p['nombre']); ?>">
                                                        <button class="btn btn-danger btn-remove" type="submit">
                                                            <i class="bi bi-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Columna resumen -->
            <div class="col-lg-4">
                <div class="total-card sticky-top" style="top: 20px;">
                    <h3 class="mb-4">
                        <i class="bi bi-receipt"></i> Resumen del Pedido
                    </h3>
                    <hr class="bg-white">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Productos:</span>
                        <span><?php echo count($lista_carrito); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span><?php echo number_format($total, 2); ?>€</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Envío:</span>
                        <span>Gratis</span>
                    </div>
                    <hr class="bg-white">
                    <div class="d-flex justify-content-between mb-4">
                        <strong class="h5">Total:</strong>
                        <strong class="h5"><?php echo number_format($total, 2); ?>€</strong>
                    </div>
                    <button class="btn btn-light w-100 mb-2 fw-bold">
                        <i class="bi bi-credit-card"></i> Proceder al Pago
                    </button>
                    <a href="../componentes/productos.php" class="btn btn-outline-light w-100">
                        <i class="bi bi-arrow-left"></i> Seguir Comprando
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../include/footer.html'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>