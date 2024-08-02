<?php
session_start(); // Inicia la sesión al principio del script

if(isset($_SESSION['nombreAdmin'])){
    session_destroy(); // Destruye todas las variables de sesión
    session_unset();  // Elimina todas las variables de sesión
}

header("Location:index.php"); // Redirige al index (ajusta la ruta si es necesario)
exit();
?>