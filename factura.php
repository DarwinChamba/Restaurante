<?php
require_once 'db_connection.php';

// Ajustar la zona horaria a Ecuador
date_default_timezone_set('America/Guayaquil');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['platos'])) {
    $platosSeleccionados = $_POST['platos'];
    
    // Obtener la fecha y la hora actual en la zona horaria de Ecuador
    $fechaHora = date('Y-m-d H:i:s');
    
    // Crear el contenido del archivo
    $contenido = "Factura de Compra\n";
    $contenido .= "Fecha y Hora: " . $fechaHora . "\n\n";
    $contenido .= "Platos Comprados:\n";
    
    $total = 0;

    foreach ($platosSeleccionados as $id) {
        $id = (int)$id;  // Asegúrate de que sea un entero
        $sql = $conn->query("SELECT nombre, precio FROM platos WHERE id = $id");

        if ($valor = $sql->fetch_object()) {
            $nombrePlato = $valor->nombre;
            $precioPlato = $valor->precio;
            $contenido .= "Nombre del Plato: $nombrePlato\nPrecio: $precioPlato\n\n";
            $total += $precioPlato;
        }
    }

    $contenido .= "Total: $total";

    // Nombre del archivo
    $nombreArchivo = "compra_platos_" . date('Ymd_His') . ".txt"; // Incluye la fecha y hora en el nombre del archivo

    // Generar el archivo para descargar
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
    echo $contenido;
    exit();
} else {
    echo "No se seleccionaron platos o petición inválida.";
}
?>


