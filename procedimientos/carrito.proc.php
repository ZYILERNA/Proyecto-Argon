<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // Recibe datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
    
    // Validar que los datos no estén vacíos
    if($nombre != '' && $precio != ''){
        
        // Formato: id|nombre|precio|stock|descripcion|imagen
        $linea = $nombre . '|' . $precio . '|' . $stock . '|' . $descripcion . '|' . $imagen . PHP_EOL;
        
        // Ruta del archivo
        $archivo_carrito = "../productos/carrito.txt";
        $archivo_reciente = "../productos/reciente.txt";
        
        // Guardar en el archivo 'a' para añadir
        $file = fopen($archivo_carrito, "a") or die("No se pudo abrir el archivo");
        $file2 = fopen($archivo_reciente, "a") or die("No se pudo abrir el archivo");
        fwrite($file, $linea);
        fwrite($file2, $linea);
        fclose($file);
        fclose($file2);
        
    }
    // Redirigir de vuelta
    header("Location: ../componentes/productos.php");
    exit;
    
} else {
    header("Location: ../componentes/index.php");
    exit;
}
?>