<?php
session_start();
require_once 'db_connection.php';

$sql = "SELECT * FROM platos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - LAS DELICIAS DE RIO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Menú de LAS DELICIAS DE RIO</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="menu.php">Menú</a></li>
            <li><a href="#">Reservaciones</a></li>
            <li><a href="#">Contacto</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            <?php else: ?>
                <li><a href="login.php">Iniciar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container">
        <h2>Nuestro Menú</h2>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='menu-item'>";
                echo "<h3>" . $row["nombre"] . "</h3>";
                echo "<p>" . $row["descripcion"] . "</p>";
                echo "<p>Precio: $" . $row["precio"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No hay platos disponibles en este momento.";
        }
        ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>