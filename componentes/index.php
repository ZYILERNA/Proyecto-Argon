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
    <link rel="stylesheet" href="style.css">
    <title>La Huerta Fresca - Inicio</title>
    
    <?php include '../include/color_fondo.php'; ?>
</head>
<body>
    <section class="hero">
        <h1>Frutas y Verduras Frescas</h1>
        <p>Directo del campo a tu mesa. Calidad y frescura garantizada.</p>
        
        <?php if (isset($_SESSION['usuario'])): ?>
            <p style="font-size: 0.9em; opacity: 0.8; margin-top: 10px;">
                👋 Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!
            </p>
            <a href="productos.php" class="btn">Ver Productos</a>
        <?php else: ?>
            <a href="login.php" class="btn">Inicia Sesión</a>
        <?php endif; ?>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="feature">
            <h3>100% Natural</h3>
            <p>Productos frescos sin químicos ni conservantes artificiales</p>
        </div>
        <div class="feature">
            <h3>Entrega Rápida</h3>
            <p>Recibe tus productos frescos en la puerta de tu casa</p>
        </div>
        <div class="feature">
            <h3>Mejor Precio</h3>
            <p>Calidad superior al mejor precio del mercado</p>
        </div>
        <div class="feature">
            <h3>Calidad Garantizada</h3>
            <p>Seleccionamos cada producto con cuidado y dedicación</p>
        </div>
    </section>
    
    <?php include '../include/footer.html'; ?>
</body>
</html>