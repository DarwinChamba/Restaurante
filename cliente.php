<?php
session_start();
if (!isset($_SESSION['nombreLogin'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/card.css">
</head>

<body>
    <script>
        function eliminar() {
            var respuesta = confirm("¿Estás seguro de que deseas comprar los platos seleccionados?");
            return respuesta;
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h1>Bienvenido: <?php echo htmlspecialchars($_SESSION['nombreLogin']); ?></h1>
            </div>
            <div class="col-12">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand btn btn-danger im" href="#"><i class="fa-solid fa-mug-hot"></i></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                                </li>
                            </ul>
                            <div class="d-flex gap-2">
                                <a href="./cerrarSesion/salirCliente.php" class="btn btn-outline-danger" role="button">
                                    Salir
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>  
    </div>
    <div class="container-fluid"> <!-- Cambiado a container-fluid para mayor flexibilidad -->
    <form action="factura.php" method="post" onsubmit="return eliminar()">
        <div class="row justify-content-center"> <!-- Esta clase centra las columnas -->
            <?php
            require_once 'db_connection.php';
            $sql = $conn->query("SELECT * FROM platos");
            while ($valor = $sql->fetch_object()) {
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> <!-- Ajustado para más opciones responsive -->
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($valor->foto) ?>" alt="Imagen de <?= htmlspecialchars($valor->nombre) ?>" class="card-img-top">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($valor->nombre) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($valor->descripcion) ?></p>
                            <div class="mt-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="platos[]" value="<?= $valor->id ?>" id="plato<?= $valor->id ?>">
                                    <label class="form-check-label" for="plato<?= $valor->id ?>">
                                        Comprar
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-12 text-center my-4"> <!-- Añadido my-4 para margen vertical -->
                <button type="submit" class="btn btn-primary">Ver Factura</button>
            </div>
        </div>
    </form>
</div>

<style>
    .card {
        margin: 0 auto; /* Esto centrará las tarjetas dentro de sus columnas */
        max-width: 300px; /* Ajusta este valor según tus necesidades */
    }
</style>
    <script src="https://kit.fontawesome.com/25921e2f9d.js" crossorigin="anonymous"></script>
</body>


</html>