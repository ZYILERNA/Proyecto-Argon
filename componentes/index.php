<?php 

if(isset($_SESSION['mensajeError'])){
    $error=$_SESSION['mensajeError'];
}
if(isset($_SESSION['sesionIniciada']=1)){
    header("Location: hlogin.php");
    exit;
} else {
    header("Location: hlogout.php");
    exit;
}


include '../include/hlogin.html'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
</head>
<body>
    
</body>
</html>

<?php include '../include/footer.html'; ?>