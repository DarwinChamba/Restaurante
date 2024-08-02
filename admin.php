<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/admin.css">
</head>

<body>
    <?php
    include ("eliminarUsuario.php");
    ?>
    <div class="container">
        <div class="row">
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
                                <a href="./cerrarSesion/salir.php" class="btn btn-outline-danger" role="button">
                                    Salir
                                </a>
                                <a href="#" class="btn btn-outline-success" role="button">
                                    Ver Menú
                                </a>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-12">
                <p class="text-center">Usuarios Registrados</p>
            </div>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Rol</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'db_connection.php';

                        $sql = $conn->query("select * from usuarios");
                        while ($valor = $sql->fetch_object()) { ?>
                            <tr>
                                <td><?= $valor->id ?></td>
                                <td><?= $valor->nombre ?></td>
                                <td><?= $valor->apellido ?></td>
                                <td><?= $valor->email ?></td>
                                <td><?= $valor->password ?></td>
                                <td><?= $valor->rol ?></td>
                                <td>
                                    <a href="./modificar/modificarUsuario.php?id=<?= $valor->id ?>" class="btn btn-danger">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <a href="admin.php?id=<?=$valor->id?>" class="btn btn-primary"> 
                                        <i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php }

                        ?>


                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="https://kit.fontawesome.com/25921e2f9d.js" crossorigin="anonymous"></script>
</body>

</html>