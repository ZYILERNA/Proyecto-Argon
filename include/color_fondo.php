<?php
$color = $_COOKIE['color_fondo'] ?? '#ffffff'; // color por defecto
echo "<style>body { background-color: $color !important; }</style>";
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