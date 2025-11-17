<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: ../componentes/index.php");
    exit;
}

// Recogemos los valores del formulario
$usuario = $_POST['nombre'] ?? '';
$clave = $_POST['clave'] ?? '';
$clave_md5 = md5($clave);

// Colores únicos para cada usuario
$colores_usuarios = [
    'usuario1' => '#FFE5E5', // Rosa claro
    'usuario2' => '#E5F0FF', // Azul claro
    'usuario3' => '#E5FFE5', // Verde claro
    'usuario4' => '#FFF5E5', // Naranja claro
    'usuario5' => '#F0E5FF', // Púrpura claro
    'usuario6' => '#FFFFE5', // Amarillo claro
];

// Recogemos el archivo de usuarios
$sresu = '../productos/sresu.txt';

if (!file_exists($sresu)) {
    die('Error: No se encuentra el archivo');
}

$lineas = file($sresu, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$validado = false;

foreach ($lineas as $linea) {
    list($user, $pass) = explode('|', trim($linea));
    
    if ($usuario === $user && $clave_md5 === $pass) {
        $validado = true;
        break;
    }
}

if ($validado) {
    // Guardamos la sesión
    $_SESSION['usuario'] = $usuario;
    
    // Crear cookie con el color del usuario (válida por 30 segundos)
    $color_usuario = $colores_usuarios[$usuario] ?? '#FFFFFF'; // Color por defecto blanco
    setcookie('color_fondo', $color_usuario, time() + (30), '/'); // 30 segundos
    setcookie('nombre_usuario', $usuario, time() + (30), '/');
    
    header("Location: ../componentes/index.php");
    exit;
} else {
    header("Location: ../componentes/error.php");
    exit;
}
?>