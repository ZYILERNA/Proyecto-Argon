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
<title>Catálogo de Productos - La Huerta Fresca</title>

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

    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .product-img {
        height: 250px;
        object-fit: cover;
        border-bottom: 3px solid #4CAF50;
    }

    .product-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #4CAF50;
    }

    .btn-add-cart {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        border: none;
        border-radius: 25px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .btn-add-cart:hover {
        background: linear-gradient(135deg, #45a049, #388e3c);
        transform: scale(1.05);
    }

    .stock-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(76, 175, 80, 0.9);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
    }

    .btn-add-product {
        background: linear-gradient(135deg, #FF9800, #F57C00);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-add-product:hover {
        background: linear-gradient(135deg, #F57C00, #E65100);
        transform: scale(1.05);
    }
</style>
<?php  include '../include/color_fondo.php'?>
</head>
<body>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-basket3-fill"></i> Nuestros Productos Frescos
        </h1>
        <p class="lead">Frutas y verduras de la mejor calidad, directamente del campo</p>
    </div>
</div>

<div class="container mb-5">
    <!-- Mostrar mensajes si existen -->
    <?php if (isset($mensajeExito)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> <?php echo htmlspecialchars($mensajeExito); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($mensajeError)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> <?php echo htmlspecialchars($mensajeError); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Grid de productos -->
    <div class="row g-4 mb-4">
        <?php foreach ($lista_productos as $p): ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <form action="../procedimientos/carrito.proc.php" method="post">
                    <div class="card product-card">
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($p['imagen']); ?>" 
                                 class="card-img-top product-img" 
                                 alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                            <span class="stock-badge">
                                <i class="bi bi-box-seam"></i> Stock: <?php echo htmlspecialchars($p['stock']); ?>
                            </span>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-2"><?php echo htmlspecialchars($p['nombre']); ?></h5>
                            <p class="card-text text-muted small mb-3">
                                <?php echo htmlspecialchars($p['descripcion']); ?>
                            </p>
                            <p class="product-price mb-3">
                                <?php echo htmlspecialchars($p['precio']); ?>
                            </p>

                            <!-- Campos ocultos -->
                            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($p['nombre']); ?>">
                            <input type="hidden" name="precio" value="<?php echo htmlspecialchars($p['precio']); ?>">
                            <input type="hidden" name="stock" value="<?php echo htmlspecialchars($p['stock']); ?>">
                            <input type="hidden" name="descripcion" value="<?php echo htmlspecialchars($p['descripcion']); ?>">
                            <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($p['imagen']); ?>">

                            <button type="submit" class="btn btn-success btn-add-cart w-100">
                                <i class="bi bi-cart-plus"></i> Agregar al carrito
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Botón añadir producto -->
    <div class="text-center mt-5">
        <a href="../componentes/formulario.php" class="btn btn-warning btn-add-product">
            <i class="bi bi-plus-circle-fill"></i> Añadir Nuevo Producto
        </a>
    </div>
</div>

<?php include '../include/footer.html'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>