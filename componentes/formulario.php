<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear Producto</title>
</head>
<body>

<?php
session_start();
if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}
?>

<main>
    <h1>Crear Nuevo Producto</h1>
    <form action="../procedimientos/crear_producto.proc.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del Producto:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" step="0.01" required><br><br>

        <label for="stock">Stock:</label><br>
        <input type="number" id="stock" name="stock" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>

        <label for="imagen">URL de la imagen:</label><br>
        <input type="text" id="imagen" name="imagen"><br><br>

        <button type="submit">Crear Producto</button>
    </form>
</main>

<?php include '../include/footer.html'; ?>
</body>
</html>
