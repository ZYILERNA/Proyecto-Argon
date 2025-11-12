<?php
session_start();

if (isset($_SESSION['usuario'])) {
    include("../include/hlogout.html");
} else {
    include("../include/hlogin.html");
}
?>
    <p>Rellena el formulario para iniciar sesión:</p>
    <main>
    <form action="../procedimientos/login.proc.php" method="POST">
        <label for="nombre">Nombre de Usuario:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="contraseña">Contraseña</label><br>
        <input type="password" id="clave" name="clave" required><br>
        <button type="submit">Iniciar Sesión</button>   
    </form>
    </main>
</body>
</html>

<?php include '../include/footer.html'; ?>
