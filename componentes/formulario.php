<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear Producto - La Huerta Fresca</title>

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

    .form-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        max-width: 700px;
        margin: 0 auto;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }

    .btn-submit {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        border: none;
        border-radius: 25px;
        padding: 12px 40px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #45a049, #388e3c);
        transform: scale(1.05);
    }

    .btn-cancel {
        background: linear-gradient(135deg, #757575, #616161);
        border: none;
        border-radius: 25px;
        padding: 12px 40px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: linear-gradient(135deg, #616161, #424242);
        transform: scale(1.05);
    }

    .icon-input {
        position: relative;
    }

    .icon-input i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #4CAF50;
        font-size: 1.2rem;
    }

    .icon-input input,
    .icon-input textarea {
        padding-left: 45px;
    }
</style>
<?php  include '../include/color_fondo.php'?>
</head>
<body>

<?php
session_start();
if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}
?>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-plus-circle-fill"></i> Crear Nuevo Producto
        </h1>
        <p class="lead">Añade productos frescos a nuestro catálogo</p>
    </div>
</div>

<div class="container mb-5">
    <div class="form-card">
        <form action="../procedimientos/crear_producto.proc.php" method="POST" enctype="multipart/form-data">
            
            <!-- Nombre -->
            <div class="mb-4">
                <label for="nombre" class="form-label">
                    <i class="bi bi-tag-fill text-success"></i> Nombre del Producto
                </label>
                <div class="icon-input">
                    <i class="bi bi-apple"></i>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                           placeholder="Ej: Manzanas Rojas" required>
                </div>
            </div>

            <!-- Precio -->
            <div class="mb-4">
                <label for="precio" class="form-label">
                    <i class="bi bi-currency-euro text-success"></i> Precio
                </label>
                <div class="icon-input">
                    <i class="bi bi-cash"></i>
                    <input type="number" class="form-control" id="precio" name="precio" 
                           step="0.01" placeholder="Ej: 2.99" required>
                </div>
                <small class="text-muted">Precio en euros por kg/unidad</small>
            </div>

            <!-- Stock -->
            <div class="mb-4">
                <label for="stock" class="form-label">
                    <i class="bi bi-box-seam-fill text-success"></i> Stock Disponible
                </label>
                <div class="icon-input">
                    <i class="bi bi-boxes"></i>
                    <input type="number" class="form-control" id="stock" name="stock" 
                           placeholder="Ej: 50" required>
                </div>
                <small class="text-muted">Cantidad disponible en kg/unidades</small>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="form-label">
                    <i class="bi bi-card-text text-success"></i> Descripción
                </label>
                <div class="icon-input">
                    <i class="bi bi-pencil-square"></i>
                    <textarea class="form-control" id="descripcion" name="descripcion" 
                              rows="4" placeholder="Describe el producto..." required></textarea>
                </div>
            </div>

            <!-- URL Imagen -->
            <div class="mb-4">
                <label for="imagen" class="form-label">
                    <i class="bi bi-image-fill text-success"></i> URL de la Imagen
                </label>
                <div class="icon-input">
                    <i class="bi bi-link-45deg"></i>
                    <input type="text" class="form-control" id="imagen" name="imagen" 
                           placeholder="https://ejemplo.com/imagen.jpg">
                </div>
                <small class="text-muted">Opcional: URL de la imagen del producto</small>
            </div>

            <!-- Botones -->
            <div class="d-flex gap-3 justify-content-center mt-5">
                <button type="submit" class="btn btn-success btn-submit">
                    <i class="bi bi-check-circle"></i> Crear Producto
                </button>
                <a href="../componentes/productos.php" class="btn btn-secondary btn-cancel">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<?php include '../include/footer.html'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>