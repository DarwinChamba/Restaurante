
<?php
session_start();

if (isset($_SESSION['nombre'])) {
    // Redirigir al usuario a la página correspondiente según su rol
    if ($_SESSION['rol'] == 'admin') {
        header("Location: admin.php");
        exit();
    } elseif ($_SESSION['rol'] == 'cliente') {
        header("Location: cliente.php");
        exit();
    } elseif ($_SESSION['rol'] == 'empleado') {
        header("Location: empleado.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'db_connection.php';
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : "";
    $email = (isset($_POST['email'])) ? $_POST['email'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";
    $rol = (isset($_POST['rol'])) ? $_POST['rol'] : "";
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

    if (empty($errores)) {
        $query = $conn->query("INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES ('$nombre', '$apellido', '$email', '$password', '$rol')");
        if ($query) {
            $_SESSION['nombre'] = $nombre;
            $_SESSION['rol'] = $rol;
            if ($rol == "admin") {
                header("Location: admin.php");
                exit();
            } elseif ($rol == "cliente") {
                header("Location: cliente.php");
                exit();
            } elseif ($rol == "empleado") {
                header("Location: empleado.php");
                exit();
            }
        } else {
            echo "<p class='alert alert-danger'>Error al crear el usuario</p>";
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
    <title>Formulario de Registro</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row align-items-center" style="min-height: 100vh;">
            <div class="col-4 d-flex align-items-center justify-content-center">
                <img src="./imagenes/programmer.svg" class="img-fluid" alt="Programmer Image">
            </div>


            <div class="col-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h2>Registro de Usuarios</h2>
                    </div>
                    <div class="card-body">
                        <form action="registrarUsuario.php" method="post">
                            <div class="form-group">
                                <label class="form-label" for="nombre">Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" id="apellido" name="apellido" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <select name="rol" id="rol" class="form-select form-control">
                                    <option value=""></option>
                                    <option value="admin">Admin</option>
                                    <option value="empleado">Empleado</option>
                                    <option value="cliente">Cliente</option>
                                </select>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary">Registrarse</button>
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