<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "../db_connection.php";
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : "";
    $apellido = isset($_POST['apellido']) ? $conn->real_escape_string($_POST['apellido']) : "";
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : "";
    $password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : "";
    $rol = isset($_POST['rol']) ? $conn->real_escape_string($_POST['rol']) : "";
    $id = isset($_POST['id']) ? $_POST['id'] : 0; // Asegúrate de que $id sea un entero válido
    echo $id;
    $errores = array();

    if (empty($nombre)) {
        $errores['nombre'] = "El campo nombre es obligatorio";
    }
    if (empty($apellido)) {
        $errores['apellido'] = "El campo apellido es obligatorio";
    }
    if (empty($email)) {
        $errores['email'] = "El campo email es obligatorio";
    }
    if (empty($password)) {
        $errores['password'] = "El campo password es obligatorio";
    }
    if (empty($rol)) {
        $errores['rol'] = "El campo rol es obligatorio";
    }

    if ($id <= 0) {
        $errores['id'] = "ID de usuario no válido";
    }

    if (empty($errores)) {
        $query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', email = '$email', password = '$password', rol = '$rol' WHERE id = $id";
        if ($conn->query($query) === TRUE) {
            header("Location: ../admin.php");
            exit();
        } else {
            echo "<p class='alert alert-danger'>Error al actualizar el usuario: " . $conn->error . "</p>";
        }
    } else {
        foreach ($errores as $error) {
            echo "<p class='alert alert-danger text-center'>$error</p>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row align-items-center" style="min-height: 100vh;">
            <div class="col-4 d-flex align-items-center justify-content-center">
                <img src="../imagenes/updateImage.svg" class="img-fluid" alt="Programmer Image">
            </div>


            <div class="col-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h2>Modificar Usuario</h2>
                    </div>
                    <div class="card-body">

                        <form action="modificarUsuario.php" method="post">
                            <input type="hidden" value="<?= $_GET['id'] ?>" name="id" >
                            <?php
                            require_once "../db_connection.php";

                            $id = $_GET['id'];
                            $sql = $conn->query("select * from usuarios where id =$id");

                            while ($row = $sql->fetch_object()) {
                                $rol = htmlspecialchars($row->rol);
                            ?>
                                <div class="form-group">
                                    <label class="form-label" for="nombre">Nombre</label>
                                    <input class="form-control" value="<?= htmlspecialchars($row->nombre) ?>" name="nombre" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input type="text" value="<?= htmlspecialchars($row->apellido) ?>" name="apellido" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" value="<?= htmlspecialchars($row->email) ?>" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" value="<?= htmlspecialchars($row->password) ?>" name="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                                </div>
                                <div class="form-group">
                                    <label for="rol">Rol</label>
                                    <select name="rol" id="rol" class="form-select form-control">
                                        <option value="" <?= ($rol == '') ? 'selected' : '' ?>></option>
                                        <option value="admin" <?= ($rol == 'admin') ? 'selected' : '' ?>>Admin</option>
                                        <option value="empleado" <?= ($rol == 'empleado') ? 'selected' : '' ?>>Empleado</option>
                                        <option value="cliente" <?= ($rol == 'cliente') ? 'selected' : '' ?>>Cliente</option>
                                    </select>
                                </div>
                            <?php
                            }
                            ?>







                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary">Modificar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Incluye Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>