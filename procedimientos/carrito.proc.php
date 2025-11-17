<?php
session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../componentes/login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // Recibe datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
    
    // Validar que los datos no estén vacíos
    if($nombre != '' && $precio != ''){
        
        // Obtener el usuario actual
        $usuario = $_SESSION['usuario'];
        
        // Formato: nombre|precio|stock|descripcion|imagen
        $linea = $nombre . '|' . $precio . '|' . $stock . '|' . $descripcion . '|' . $imagen . PHP_EOL;
        
        // Ruta del archivo PERSONAL del usuario
        $archivo_carrito = "../productos/carrito_" . $usuario . ".txt";
        $archivo_reciente = "../productos/reciente_" . $usuario . ".txt";
        
        // Guardar en el archivo personal del usuario
        $file = fopen($archivo_carrito, "a") or die("No se pudo abrir el archivo del carrito");
        $file2 = fopen($archivo_reciente, "a") or die("No se pudo abrir el archivo reciente");
        fwrite($file, $linea);
        fwrite($file2, $linea);
        fclose($file);
        fclose($file2);
        
        $_SESSION['mensajeExito'] = "Producto añadido al carrito correctamente";
    } else {
        $_SESSION['mensajeError'] = "Error al añadir el producto al carrito";
    }
    
    // Redirigir de vuelta
    header("Location: ../componentes/productos.php");
    exit;
    
} else {
    header("Location: ../componentes/index.php");
    exit;
}
?>