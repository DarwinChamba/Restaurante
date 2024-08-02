<?php
/*
session_start();

// Verificar si el usuario está logueado y es un cliente
if (!isset($_SESSION['nombreLogin']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: login.php");
    exit();
}
    */

session_start(); // Asegúrate de iniciar la sesión al principio del archivo

// Verifica si el usuario está logueado
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

                            <?php

                            //include("./cerrarSesion/salirCliente.php");
                            ?>
                            <div class="d-flex gap-2">
                                <a href="./cerrarSesion/salirCliente.php" class="btn btn-outline-danger" role="button">
                                    Salir
                                </a>
                                <a href="menu.php" class="btn btn-outline-success" role="button">
                                    Ver Factura
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            require_once 'db_connection.php';
            $sql = $conn->query("select * from platos");
            while ($valor = $sql->fetch_object()) {
            ?>
                <div class="col-md-4"> <!-- Ajusta el tamaño de la columna según tu diseño -->
                    <div class="card">
                        <img src="<?= $valor->foto ?>" alt="Imagen de la tarjeta" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $valor->nombre ?></h5>
                            <p class="card-text"><?= $valor->descripcion ?></p>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $valor->id ?>">Ver Detalles</a>
                            <!-- Button trigger modal -->


                        </div>
                    </div>
                </div>


            <?php
            }
            ?>

        </div>

    </div>





    <script src="https://kit.fontawesome.com/25921e2f9d.js" crossorigin="anonymous"></script>
</body>

</html>