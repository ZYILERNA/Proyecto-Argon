<?php
session_start();

if(isset($_SESSION['mensajeError'])){
    $error=$_SESSION['mensajeError'];
}
if(!isset($_SESSION['sesionIniciada'])){
    $_SESSION['sesionIniciada']=0;
    $session=$_SESSION['sesionIniciada'];
}elseif(isset($_SESSION['sesionIniciada'])){
    $session=1;
}

include '../include/hlogout.html'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>LOGIN</title>
</head>
<body>
<div class="menu">
        <h1>Login</h1>

        <div class="buttons">
            <form action="../procedimientos/login.proc.php" method="post">
                <p>Usuario:</p>
                <input type="text" name="user" required>
                <p>Contraseña:</p>
                <input type="text" name="password" required>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <?php
            if(isset($session) && $session !=0 ){
                if(isset($error) && $error != ''){
                ?> <p>Error: <?php echo $error ?></p><?php  
                }
            } 
            ?>
    </div>
</body>
</html>

<?php include '../include/footer.html'; ?>
