<?php
session_start();
session_unset();
header("Location: ../componentes/index.php"); 
exit;
?>