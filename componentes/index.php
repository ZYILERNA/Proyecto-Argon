<?php
session_start();

if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Huerta Fresca - Inicio</title>
    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    
    <style>
        body {
            min-height: 100vh;
        }

        .hero {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 6rem 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }

        .btn-hero {
            background: white;
            color: #4CAF50;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: bold;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-hero:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            color: #45a049;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 4rem;
            color: #4CAF50;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
    <?php  include '../include/color_fondo.php'?>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h1><i class="bi bi-basket3-fill"></i> Frutas y Verduras Frescas</h1>
            <p>Directo del campo a tu mesa. Calidad y frescura garantizada.</p>
            
            <?php if (isset($_SESSION['usuario'])): ?>
                <p class="mb-3">¡Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>!</p>
                <a href="productos.php" class="btn-hero">
                    <i class="bi bi-basket2"></i> Ver Productos
                </a>
            <?php else: ?>
                <a href="login.php" class="btn-hero">
                    <i class="bi bi-box-arrow-in-right"></i> Inicia Sesión
                </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Features -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <i class="bi bi-leaf feature-icon"></i>
                        <h3>100% Natural</h3>
                        <p>Productos frescos sin químicos ni conservantes artificiales</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <i class="bi bi-truck feature-icon"></i>
                        <h3>Entrega Rápida</h3>
                        <p>Recibe tus productos frescos en la puerta de tu casa</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <i class="bi bi-currency-euro feature-icon"></i>
                        <h3>Mejor Precio</h3>
                        <p>Calidad superior al mejor precio del mercado</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <i class="bi bi-star-fill feature-icon"></i>
                        <h3>Calidad Garantizada</h3>
                        <p>Seleccionamos cada producto con cuidado y dedicación</p>
                    </div>
                </div>
        </div>
    </section>
    
    <?php include '../include/footer.html'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>