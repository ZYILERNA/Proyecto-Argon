<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: ../componentes/index.php");
    exit;
}

//Recogemos los valores del formulario rellenado en login.html
$usuario = $_POST['nombre'] ?? '';
$clave = $_POST['clave'] ?? '';
$clave_md5 = md5($clave);

/** echo "Clave desde el formulario: $clave<br/>";
*echo "Clave encriptada: $clave_md5<br/>";
*/




//Recogemos en variable el archivo que tiene el usuario y clave
$sresu = '../productos/sresu.txt';
//En caso de que no exista dicho archivo
if (!file_exists ($sresu)) {
    die('Error: No se encuentra el archivo');
}
//El método file lee un archivo y añade su contenido en un array
$lineas = file($sresu, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$validado = false;

foreach ($lineas as $linea) {
    //Separamos el usuario de la clave con el método explode, entre " " el elemento que separe ambos en el archivo txt. Con el trim eliminamos espacios en blanco 
    list($user, $pass) = explode('|', trim($linea));
    echo "Fichero:<br/>";
    echo "Usuario: $user<br/>";
    echo "Passrord: $pass<br/>";
    //Validamos si lo introducido es igual a lo que tenemos en el archivo
    if ($usuario === $user && $clave_md5 === $pass) {
        $validado = true;
        break;
    }
}

if ($validado) {
    $_SESSION['usuario'] = $usuario; // Guardamos la sesión
    header("Location: ../componentes/index.php");
    exit;
} else {
    header("Location: ../componentes/error.php");
    exit;
}

?>