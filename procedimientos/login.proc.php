<?php
session_start();
if(isset($_REQUEST['user']) && isset($_REQUEST['password'])){
    $_SESSION['user']=$_REQUEST['user'];
    $_SESSION['password']=$_REQUEST['password'];
    
}elseif(!isset($_SESSION['mensajeError'])){
    $_SESSION['mensajeError'];
}


$user=$_SESSION['user'];
$password=md5($_SESSION['password']);



$my_users= "../productos/users.txt";
$my_file= fopen($my_users,"r") or die("Unable to open file!");
$validacion=false; 

while(!feof($my_file)){

    $datos=explode(";",fgets($my_file));
    if($user == $datos[0]){
        
        if($password == trim($datos[1])){
            $validacion=true;
            break;
        }
    }

}

fclose($my_file);


if($validacion){
    $_SESSION['sesionIniciada'] = 1;
    header("Location: ../componentes/index.php");
    exit;
}else{
    $_SESSION['sesionIniciada'] = 0;
    $_SESSION['mensajeError']="Las credenciales son incorrectas. Inténtelo de nuevo.";
    header('Location: ../componentes/login.php');
    exit;
}



?>