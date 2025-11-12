<?php
session_start();

if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recientemente</title>
</head>
<body>
    
</body>
</html>

<?php include '../include/footer.html'; ?>