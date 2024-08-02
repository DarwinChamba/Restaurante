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
    <div class="container">
        <div class="row">
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
                                <td><?= $valor->rol?></td>
                                <td>
                                    <a href="" class="btn btn-danger"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn btn-primary"> <i class="fa-solid fa-trash"></i></a>    
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