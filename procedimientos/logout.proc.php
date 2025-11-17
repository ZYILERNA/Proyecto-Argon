<?php
session_start();

// Obtener el usuario antes de destruir la sesión (por si necesitamos hacer algo)
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';

// Destruir la sesión
session_unset();
session_destroy();

// Eliminar las cookies estableciendo su tiempo de expiración en el pasado
setcookie('color_fondo', '', time() - 3600, '/');
setcookie('nombre_usuario', '', time() - 3600, '/');

// NOTA: El carrito y el historial se mantienen guardados en archivos personales
// Si quieres que se borren al cerrar sesión, descomenta las siguientes líneas:

/*
if ($usuario != '') {
    $archivo_carrito = "../productos/carrito_" . $usuario . ".txt";
    $archivo_reciente = "../productos/reciente_" . $usuario . ".txt";
    
    if (file_exists($archivo_carrito)) {
        unlink($archivo_carrito); // Elimina el archivo del carrito
    }
    
    if (file_exists($archivo_reciente)) {
        unlink($archivo_reciente); // Elimina el archivo del historial
    }
}
*/

header("Location: ../componentes/index.php"); 
exit;
?>