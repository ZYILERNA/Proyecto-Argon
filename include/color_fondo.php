<?php
// Obtener el color de fondo de la cookie (si existe)
$color_fondo = isset($_COOKIE['color_fondo']) ? $_COOKIE['color_fondo'] : '#FFFFFF';
$nombre_usuario = isset($_COOKIE['nombre_usuario']) ? $_COOKIE['nombre_usuario'] : '';
?>

<style>
    body {
        background-color: <?php echo htmlspecialchars($color_fondo); ?>;
        transition: background-color 0.5s ease;
    }
    
    /* Overlay sutil para mejorar la legibilidad */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 100%);
        pointer-events: none;
        z-index: -1;
    }
</style>