<?php
session_start();

if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}
$usuario = basename($_SESSION['usuario']);

$carritos = "../productos/reciente_" . $usuario . ".txt";

if (file_exists($carritos)) {
    $lineas = file($carritos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $lineas = [];
}

$lista_carrito = [];

foreach ($lineas as $linea) {
    $datos = explode('|', $linea);
    $nombre = trim($datos[0]);

    if (!isset($lista_carrito[$nombre])) {
        $lista_carrito[$nombre] = [
            'nombre' => $nombre,
            'precio' => trim($datos[1]),
            'stock' => trim($datos[2]),
            'descripcion' => trim($datos[3]),
            'imagen' => trim($datos[4]),
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visto Recientemente - La Huerta Fresca</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        min-height: 100vh;
    }

    .hero-section {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .product-card {
        transition: transform 0.3s ease;
        border: none;
        border-radius: 15px;
        background: white;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .product-img {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
</style>
<?php  include '../include/color_fondo.php'?>
</head>
<body>

<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-clock-history"></i> Visto Recientemente
        </h1>
        <p class="lead">Productos que has consultado recientemente</p>
    </div>
</div>

<div class="container mb-5">
    <?php if (empty($lista_carrito)): ?>
        <div class="text-center py-5">
            <i class="bi bi-eye-slash" style="font-size: 5rem; color: #ccc;"></i>
            <h2 class="mt-4 text-muted">No has visto productos recientemente</h2>
            <a href="../componentes/productos.php" class="btn btn-success btn-lg mt-3">
                <i class="bi bi-basket3"></i> Ver Productos
            </a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($lista_carrito as $p): ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card product-card">
                        <img src="<?php echo htmlspecialchars($p['imagen']); ?>" 
                             class="product-img" 
                             alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($p['nombre']); ?></h5>
                            <p class="card-text text-muted small"><?php echo htmlspecialchars($p['descripcion']); ?></p>
                            <p class="h5 text-success"><?php echo htmlspecialchars($p['precio']); ?></p>
                            <span class="badge bg-success">Stock: <?php echo htmlspecialchars($p['stock']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include '../include/footer.html'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>